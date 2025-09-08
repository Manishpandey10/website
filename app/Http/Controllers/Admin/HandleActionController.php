<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\Image;
use App\Models\Products;
use App\Models\VariantImage;
use Illuminate\Http\Request;

class HandleActionController extends Controller
{
    // public function viewImage($id)
    // {
    //     $productdata = Products::find($id);
    //     $imageData = Image::where('product_id', $id)->get();
    //     $variantImageData = VariantImage::where('product_id', $id)->get();
    //     // dd($variantImageData);
    //     $colorIds = $variantImageData->pluck('color_id')->unique();
    //     dd($colorIds);

    //     $colorData = Color::whereIn('id', $colorIds)->get();
    //     // dd($colorData);

    //     return view('admin.product.handleImage', compact(
    //         'imageData',
    //         'productdata',
    //         'variantImageData',
    //         'colorData'
    //     ));
    // }
    
    public function viewImage($id)
    {
        $productdata = Products::find($id);
        $imageData = Image::where('product_id', $id)->get();
        $variantImageData = VariantImage::where('product_id', $id)->get();

        // $imagesGroupedByColor = $variantImageData->groupBy('color_id');
        $imagesGroupedByColor = VariantImage::where('product_id', $id)->get()->groupBy('color_id');

        // dd($imagesGroupedByColor);

        $colorData = Color::whereIn('id', $imagesGroupedByColor->keys())->get()->keyBy('id');
        // dd($colorData);

        return view('admin.product.handleImage', compact(
            'imageData',
            'productdata',
            'variantImageData',
            'imagesGroupedByColor',
            'colorData'
        ));
    }



    public function handleImages($id)
    {
        $productdata = Products::find($id);
        $imageData = Image::where('product_id', $id)->get();
        // dd($imageData);

        return view('admin.product.editImage', compact('imageData', 'productdata'));
    }
    // public function updateImages(Request $request, $id)
    // {
    //     $request->validate([
    //         'productthumbnail.*' => 'nullable',
    //     ]);

    //     $updateImage = Products::find($id);



    //     if ($files = $request->file('productthumbnail')) {
    //         foreach ($files as $file) {
    //             $extension = $file->getClientOriginalExtension();
    //             $filename = time() . '-' . uniqid() . '.' . $extension;
    //             $file->move(public_path('/ProductThumbnail'), $filename);

    //             $updateImage = new Image();
    //             $updateImage->name = $filename;
    //             $updateImage->product_id = $id;

    //                dd($updateImage);
    //             $updateImage->save();
    //         }
    //     }
    //     return redirect()->route('manage.product')->with('imageUpdated', 'Product images has been updated');
    // }

    public function updateImages(Request $request, $id)
    {
        $request->validate([
            'productthumbnail.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->has('remove_images')) {
            $removeIds = explode(',', $request->input('remove_images'));
            foreach ($removeIds as $imageId) {
                $image = Image::find($imageId);
                if ($image) {
                    // Delete file from disk
                    $filePath = public_path('ProductThumbnail/' . $image->name);
                    if (file_exists($filePath)) {
                        @unlink($filePath);
                    }
                    // Delete DB record
                    $image->delete();
                }
            }
        }

        if ($request->hasFile('productthumbnail')) {
            foreach ($request->file('productthumbnail') as $file) {
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '-' . uniqid() . '.' . $extension;
                $file->move(public_path('/ProductThumbnail'), $filename);

                $newImage = new Image();
                $newImage->name = $filename;
                $newImage->product_id = $id;
                $newImage->save();
            }
        }

        return redirect()->route('manage.product')->with('imageUpdated', 'Product images have been updated successfully.');
    }


    public function deleteImage($id)
    {
        $data = Image::find($id);
        // dd($data);

        $data->delete();

        return redirect()->back()->with('deleted', 'Item has been deleted');
    }
}

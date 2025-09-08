<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\Image;
use App\Models\Products;
use App\Models\VariantImage;
use App\Models\Variant;
use Illuminate\Http\Request;

class ManageImageVarient extends Controller
{
    public function viewImage($id)
    {
        $productdata = Products::find($id);
        $imageData = Image::where('product_id', $id)->get();
        // dd($imageData);
        $variantImageData = VariantImage::where('product_id', $id)->get();

        // $imagesGroupedByColor = $variantImageData->groupBy('color_id');
        $imagesGroupedByColor = VariantImage::where('product_id', $id)->get()->groupBy('color_id');

        // dd($imagesGroupedByColor);

        $colorData = Color::whereIn('id', $imagesGroupedByColor->keys())->get()->keyBy('id');
        // dd($colorData);
        // return response()->json([
        //     'msg'=>"fetched successfully",
        //     '$colordata'=>$colorData,
        //     'productdata'=>$productdata
        // ]);
        return view('admin.images.manageImageVarient', compact(
            'imageData',
            'productdata',
            'variantImageData',
            'imagesGroupedByColor',
            'colorData'
        ));
    }
    public function index($id)
    {
        $imageData = Image::where('product_id', $id)->get();
        $productdata = Products::find($id);

        $varientdata = Variant::where('product_id', $id)->get()->groupBy('color_id');
        // dd($varientdata);
        $colordata =  Color::whereIn('id', $varientdata->keys())->get()->keyBy('id');
        // dd($colordata);
        return view('admin.images.addImageVarient', compact('colordata', 'productdata', 'imageData'));
    }
    public function updateImages(Request $request, $id)
    {
        $colorIdFromQuery = $request->query('color'); // This gets ?color=123 from URL

        // dd($colorIdFromQuery);
        $request->validate([
            'variantthumbnail.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $existingImage = VariantImage::where('color_id', $colorIdFromQuery)
        ->where('product_id',$id)
        ->get();


        // dd("yoi",$existing);

        if (!$existingImage->isEmpty()) {
            // dd("image related to that color already exists, please use edit option");
            return redirect()->route('manage.variant.image', $id)->with('variantImageAccessDenied', 'Please Use edit option to add/update new images for existing variant images');
            // return redirect()->back()->with('variantImageAccessDenied', 'Please Use edit option to add/update new images for existing variant images');
        } else {

            if ($request->has('remove_images')) {
                $removeIds = explode(',', $request->input('remove_images'));
                foreach ($removeIds as $imageId) {
                    $image = Image::find($imageId);
                    if ($image) {
                        // Delete file from disk
                        $filePath = public_path('variantThumbnail/' . $image->name);
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
                    $file->move(public_path('/variantThumbnail'), $filename);

                    $newImage = new VariantImage();
                    $newImage->name = $filename;
                    $newImage->color_id = $request->color;
                    $newImage->product_id = $id;
                    $newImage->save();
                }
            }

            return redirect()->route('manage.variant.image', $id)->with('VariantImageAdded', 'Product variant images have been updated successfully.');
        }
    }

    public function edit($color_id, $product_id)
    {
        // $imageData = Image::where('product_id', $id)->get();
        $imagedata = VariantImage::where('color_id', $color_id)
            ->where('product_id', $product_id)
            ->get();
        $productdata = Products::find($product_id);
        $colorId = $color_id;
        // dd($colorId);
        // dd($imagedata);

        return view('admin.images.editImageVarient', compact('imagedata', 'productdata', 'colorId'));
    }
    public function submit(Request $request, $color_id, $product_id)
    {
        $request->validate([
            'productthumbnail.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
        // $remove = $request->input('remove_images');
        // dd($remove); // checking the specific image is selected
        if ($request->has('remove_images')) {
            $removeIds = explode(',', $request->input('remove_images'));
            foreach ($removeIds as $imageId) {
                $image = VariantImage::find($imageId);
                if ($image) {
                    // Delete file from disk
                    $filePath = public_path('variantThumbnail/' . $image->name);
                    if (file_exists($filePath)) {
                        @unlink($filePath);
                    }
                    // Delete DB record
                    $image->delete();
                }
            }
        }
        //adding new pictures
        if ($request->hasFile('variantthumbnail')) {
            foreach ($request->file('variantthumbnail') as $file) {
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '-' . uniqid() . '.' . $extension;
                $file->move(public_path('/variantThumbnail'), $filename);

                $newImage = new VariantImage();
                $newImage->name = $filename;
                $newImage->color_id = $color_id;
                $newImage->product_id = $product_id;
                $newImage->save();
            }
        }

        return redirect()->route('manage.variant.image', $product_id)->with('VariantImageUpdated', 'Product image variant images have been edited');
    }
    public function delete($color_id, $product_id)
    {

        $data = VariantImage::where('color_id', $color_id)
            ->where('product_id', $product_id)
            ->get();
        // dd($data);
        $data->each->delete();
        return redirect()->route('manage.variant.image', $product_id)->with('variantImageDeleted', 'All Product variant images related to color has been deleted.');
    }
}

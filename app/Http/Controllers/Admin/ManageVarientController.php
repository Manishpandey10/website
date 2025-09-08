<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Support\Str;
use App\Models\Hsn;
use App\Models\Products;
use App\Models\TaxSlab;
use App\Models\Variant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Stmt\Foreach_;
use Symfony\Component\Console\Input\Input;

use function PHPUnit\Framework\isEmpty;

class ManageVarientController extends Controller
{
    public function manage($id)
    {
        $productdata = Products::find($id);
        // dd($productdata);
        $variantdata = Variant::with('color')->where('product_id', $id)->get();
        // dd($variantdata);
        // return response()->json([
        //     'msg'=>'data fetched successfully',
        //     'data'=>$variantdata,
        // ]);

        return view('admin.varient.manageVarient', compact('productdata', 'variantdata'));
    }

    public function index($id)
    {
        $productdata = Products::find($id);

        $colordata = Color::all();
        $hsn = Hsn::all();
        $gst = TaxSlab::all();
        return view('admin.varient.addNewVarient', compact('productdata', 'colordata', 'hsn', 'gst'));
    }

    public function addVarient(Request $request, $id)
    {

        $request->validate([
            'color' => 'required',
            'metaTitle' => 'required',
            'metaDescription' => 'required',
            'variantImgTitle' => 'required',
            'variantImgAltTag' => 'required'
        ], [
            'color.required' => 'Select Color field is required.',
            'metaTitle.required' => 'Enter Meta Title field is required.',
            'metaDescription.required' => 'Enter Meta Description field is required.',
            'variantImgTitle.required' => 'Enter variant Image Title field is required.',
            'variantImgAltTag.required' => 'Enter variant Image AltTag field is required.'
        ]);

        // $metaTitle = $request->input('metaTitle');
        // // dd('meta tile value:',$request->variantImgTitle);
        // $metaDescription = $request->input('metaDescription');
        // $variantImgTitle = $request->input('variantImgTitle');
        // $variantImgAltTag = $request->input('variantImgAltTag');

        for ($i = 1; $i <= 14; $i++) {
            $size = $request->input("value{$i}");
            $sku = $request->input("sku{$i}");
            $stock = $request->input("stock{$i}");
            $weight = $request->input("weight{$i}");
            $price = $request->input("price{$i}");
            $discount = $request->input("discount{$i}");
            $hsn = $request->input("hsn{$i}");
            $gst = $request->input("gst{$i}");

            // dd("price{$i} =>", $price);

            if (
                empty($sku) && empty($size)  && empty($stock)  && empty($discount)  && empty($price) &&
                empty($weight) && empty($hsn) && empty($gst)
            ) {
                continue;
            }

            $discountedPrice = ($price * $discount) / 100;

            Variant::updateOrCreate(
                [
                    'product_id' => $id,
                    'color_id' => $request->color,
                    'size' => $size,
                ],
                [
                    'sku' => $sku,
                    'stock' => $stock,
                    'weight' => $weight,
                    'price' => $price,
                    'discount' => $discount,
                    'discountedPrice' => $discountedPrice,
                    'hsn' => $hsn,
                    'gst' => $gst,
                    'metaTitle' => $request->input('metaTitle'),
                    'metaDescription' => $request->input('metaDescription'),
                    'variantImgTitle' => $request->input('variantImgTitle'),
                    'variantImgAltTag' => $request->input('variantImgAltTag'),
                ]
            );
            // dd($newVariant);// checking weather variant has been created or not
        }

        // return response()->json([
        //     'message' => 'Variant added successfully!',
        //     'redirect_url' => route('manage.varient',$id)
        // ]); 

        return redirect()->route('manage.varient', $id)->with('VarientAdded', 'Product variants updated successfully');

    }


    public function edit($variant_id, $product_id)
    {
        $productdata = Products::find($product_id);
        $editdata = Variant::with('color')->findOrFail($variant_id); // selected variant
        $variant_color_id = $editdata->color->id; //extracting color_id for that product variant
        // dd("variant color id is ", $variant_color_id);

        $colordata = Color::where('id', $variant_color_id)->first();
        $hsn = Hsn::all();
        $gst = TaxSlab::all();

        // dd($productdata);
        // dd($editdata);
        // dd($colordata);

        // Size to row number map
        $sizeMap = [
            '24 (2-3 Years)' => 1,
            '26 (4-5 Years)' => 2,
            '28 (6-7 Years)' => 3,
            '30(8-9 Years)' => 4,
            '32(10-11 Years)' => 5,
            '34(12-13 Years)' => 6,
            'XS' => 7,
            'S' => 8,
            'M' => 9,
            'L' => 10,
            'XL' => 11,
            'XXL' => 12,
            'XXXL' => 13,
            'FS' => 14,
        ];

        // Fetch all variants that belong to the same product and color
        $relatedVariants = Variant::where('product_id', $editdata->product_id)
            ->where('color_id', $editdata->color_id)
            ->get();

        // Get row numbers for all matching sizes
        $rowsToEnable = $relatedVariants->pluck('size')->map(function ($size) use ($sizeMap) {
            return $sizeMap[$size] ?? null;
        })->filter()->values()->toArray();

        return view('admin.varient.editProductVarient', [
            'editdata' => $editdata,
            'hsn' => $hsn,
            'colordata' => $colordata,
            'gst' => $gst,
            'rowsToEnable' => $rowsToEnable,
            'relatedVariants' => $relatedVariants,
            'productdata' => $productdata,
        ]);
    }

    // public function update(Request $request, )
    // {
    //     $request->validate(
    //         [
    //             'color' => 'required',
    //         ],
    //         [
    //             'color.required' => 'Select Color field is required.',
    //         ]
    //     );

    //     for ($i = 1; $i <= 14; $i++) {
    //         $size = $request->input("value{$i}");
    //         $sku = $request->input("sku{$i}");
    //         $stock = $request->input("stock{$i}");
    //         $weight = $request->input("weight{$i}");
    //         $hsn = $request->input("hsn{$i}");
    //         $gst = $request->input("gst{$i}");

    //         if (
    //             empty($sku) && empty($size) && empty($stock) &&
    //             empty($weight) && empty($hsn) && empty($gst)
    //         ) {
    //             continue;
    //         }

    //         Varient::updateOrCreate(
    //             [

    //                 'color_id' => $request->color,
    //                 'size' => $size,
    //             ],
    //             [
    //                 'sku' => $sku,
    //                 'stock' => $stock,
    //                 'weight' => $weight,
    //                 'hsn' => $hsn,
    //                 'gst' => $gst,
    //             ]
    //         );
    //     }

    //     return redirect()->route('manage.varient',)->with('VarientUpdated', 'Product variants details has been updated successfully');
    // }
    public function update(Request $request, $variant_id, $product_id)
    {
        $request->validate(
            [
                'color' => 'required',
            ],
            [
                'color.required' => 'Select Color field is required.',
            ]
        );

        for ($i = 1; $i <= 14; $i++) {
            $size = $request->input("value{$i}");
            $sku = $request->input("sku{$i}");
            $stock = $request->input("stock{$i}");
            $weight = $request->input("weight{$i}");
            $price = $request->input("price{$i}");
            $discount = $request->input("discount{$i}");
            $hsn = $request->input("hsn{$i}");
            $gst = $request->input("gst{$i}");

            //calculating discounted price
            $discountedPrice = ($price * $discount) / 100;

            if (
                empty($sku) && empty($size) && empty($stock) &&
                empty($weight) &&
                empty($discount) &&
                empty($price) && empty($hsn) && empty($gst)
            ) {
                continue;
            }

            Variant::updateOrCreate(
                [
                    'product_id' => $product_id,
                    'color_id' => $request->color,
                    'size' => $size,
                ],
                [
                    'sku' => $sku,
                    'stock' => $stock,
                    'price' => $price,
                    'discount' => $discount,
                    'discountedPrice' => $discountedPrice,
                    'weight' => $weight,
                    'hsn' => $hsn,
                    'gst' => $gst,
                ]
            );
        }

        return redirect()->route('manage.varient', $product_id)->with('VarientUpdated', 'Product variant details have been updated successfully');
    }
}

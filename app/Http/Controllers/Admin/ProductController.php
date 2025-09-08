<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Color;
use App\Models\Filter;
use App\Models\Image;
use App\Models\Products;
use App\Models\ProductType;
use App\Models\SuitableFor;
use App\Models\Tag;
use GuzzleHttp\Promise\Each;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $productData = Products::with('products_category')->with('filters')->get(); //products will come back with category part.
        // dd($productData); 
        // $product_categroy = $productData->products_category;
        // dd($product_categroy);


        $images = Image::all();
        // $data=[$productData, $images];

        // return response()->json([
        //     'msg'=>'data about product and image has been fetched.',
        //     'data'=>$data,
        // ]);
        $categoryData = Category::all();
        // dd($categoryData);

        return view('admin.product.manageProducts', compact('productData', 'images'));
    }
    public function show()
    {
        $categoryData = Category::whereHas('subcategory')->with('subcategory')->get();
        // dd($productData);
        // dd($categoryData);
        $filterData = Filter::all();
        $colorData = Color::all();
        $typeData = ProductType::all();
        $suitableData = SuitableFor::all();
        $tagsData = Tag::all();

        return view('admin.product.addNewProduct', compact('categoryData', 'filterData', 'colorData', 'tagsData', 'typeData', 'suitableData'));
    }
    public function store(Request $request)
    {
        $request->validate(
            [
                'productname' => 'required',
                'productthumbnail.*' => 'nullable|image|mimes:png,jpg,jpeg',
                'productCategory' => 'required|array|min:1',
                'productCategory.*' => 'required',
                'articleCode' => 'required',
                'brand' => 'required|in:1,2,3',
                'filter' => 'required|array|min:1',
                'filter.*' => 'required|exists:filters,id',
                'productDescription' => 'required',
                'barcode' => 'required',
                'suitable' => 'required',
                'productType' => 'required|exists:product_types,id',
                'productType' => 'required',
                'filter' => 'required',
                'metaTitle' => 'required',
                'metaDescription' => 'required',
                'stock' => 'required',
                'price' => 'required',
                // 'material' => 'required',
                'discount' => 'required',
                'tags' => 'required',
                'packingInfo' => 'nullable',
                'packerInfo' => 'nullable',
                'productHighlight' => 'nullable',
                'productStatus' => 'required|in:0,1',
                'gender' => 'required|in:0,1,2',
                'additionalInfo' => 'nullable',

            ],
            [
                'productname.required' => 'Enter Product Name field is required',
                'productthumbnail.required' => 'Upload Thumbnail field is required',
                'productCategory.required' => 'Category field is required',
                'suitable.required' => 'Suitable for  field is required',
                'barcode.required' => 'Barcode (ISBN, UPC, GTIN, etc.)  field is required',
                'articleCode.required' => 'Article Code field is required',
                'brand.required' => 'Select Brand field is required',
                'metaTitle.required' => 'Enter Meta Title field is required',
                'productType.required' => 'Enter product type field is required',
                'metaDescription.required' => 'Enter Meta Description field is required',
                'filter.required' => 'Select filter field is required',
                'stock.required' => 'Stock field is required.',
                'price.required' => 'Enter Price field is required',
                'tags.required' => 'Tags field is required',
                'material.required' => 'Fabric/Material field is required',
                'discount.required' => 'Enter Discount field is required',
                'productStatus.required' => 'Status field is required',
                'gender.required' => 'Gender field is required',
            ]
        );

        // dd($request->productCategory);

        $discount = $request->discount; // fetched the discount value 
        $price = $request->price; // fetched the original price entered 

        $discountedPrice = ($price * $discount) / 100; // discounted price 
        $Calculated = $price - $discountedPrice; // total price after discount 

        // dd('calculatedPrice is ', $Calculated, 'and actual price is ' ,$price);

        $newProduct = new Products();

        $newProduct->name = $request->productname;

        $newProduct->description = $request->productDescription;
        $newProduct->articleCode = $request->articleCode; //adding article code in db
        $newProduct->brand = $request->brand; // adding brand value in db
        $newProduct->barcode = $request->barcode; // adding barcode field in db
        $newProduct->productType = $request->productType;
        $newProduct->metaDescription = $request->metaDescription;
        $newProduct->metaTitle = $request->metaTitle;
        $newProduct->actualprice = $request->price;
        $newProduct->material = $request->material; //adding material field in db
        $newProduct->discountedPrice = $Calculated;
        $newProduct->discount = $request->discount;
        $newProduct->status = $request->productStatus;
        $newProduct->gender = $request->gender; // adding gender field into db
        $newProduct->stock = $request->stock;
        if ($request->has('productHighlight')) {
            $newProduct->highlight = $request->productHighlight;
        }
        if ($request->has('additionalInfo')) {
            $newProduct->additional_information = $request->additionalInfo;
        }

        // dd($newProduct);
        $newProduct->save();

        if ($files = $request->file('productthumbnail')) {
            foreach ($files as $file) {
                $extension = $file->getClientOriginalExtension();
                $extension =     $file->getClientOriginalExtension();
                $filename = time() . '-' . uniqid() . '.' . $extension;
                $file->move(public_path('/ProductThumbnail'), $filename);

                $newImage = new Image();
                $newImage->name = $filename;
                $newImage->product_id = $newProduct->id;
                $newImage->save();
            }
        }



        if ($request->has('productCategory')) {
            $newProduct->products_category()->attach($request->productCategory); // for storing multiple select category using pivot table.
        }
        if ($request->has('filter')) {
            $newProduct->filters()->attach($request->filter);
        }

        if ($request->has('suitable')) {
            $newProduct->suitableFor()->attach($request->suitable);
        }
        if ($request->has('tags')) {
            $newProduct->tags()->attach($request->tags);
        }


        // dd($newProduct);
        if ($request->ajax()) {
            return response()->json([
                'message' => 'New Product has been added..',
                'redirect_url' => route('manage.product')
            ]);
        }
        return redirect()->route('manage.product')->with('newProductAdded', 'New Product has been added.');
    }
    public function edit($id)
    {
        $productdata = Products::with('products_category')->with('filters')->find($id);
        $images = Image::Where('product_id', $id)->get();
        $filterData = Filter::all();
        $categoryData = Category::whereHas('subcategory')->with('subcategory')->get();
        $typeData = ProductType::all();
        $colorData = Color::all();
        $typeData = ProductType::all();
        $suitableData = SuitableFor::all();
        $tagsData = Tag::all();

        // dd($productdata->brand);
        // dd($categorydata);
        // dd($productdata);
        return view('admin.product.editProduct', compact('productdata', 'categoryData', 'images', 'filterData', 'typeData', 'suitableData', 'tagsData'));
    }
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'productname' => 'required',
                'productthumbnail.*' => 'nullable|image|mimes:png,jpg,jpeg',
                'productCategory' => 'required|array|min:1',
                'productCategory.*' => 'required',
                'articleCode' => 'required',
                'brand' => 'required|in:1,2,3',
                'filter' => 'required|array|min:1',
                'filter.*' => 'exists:filters,id',
                'productDescription' => 'required',
                'barcode' => 'required',
                'suitable' => 'required',
                'productType' => 'required|exists:product_types,id',
                'filter' => 'required',
                'metaTitle' => 'required',
                'metaDescription' => 'required',
                'stock' => 'required',
                'price' => 'required',
                'material' => 'required',
                'discount' => 'required',
                'tags' => 'required',
                'packingInfo' => 'nullable',
                'packerInfo' => 'nullable',
                'productHighlight' => 'nullable',
                'productStatus' => 'required|in:0,1',
                'gender' => 'required|in:0,1,2',
                'additionalInfo' => 'nullable',

            ],
            [
                'productname.required' => 'Enter Product Name field is required',
                'productthumbnail.required' => 'Upload Thumbnail field is required',
                'productCategory.required' => 'Category field is required',
                'suitable.required' => 'Suitable for  field is required',
                'barcode.required' => 'Barcode (ISBN, UPC, GTIN, etc.)  field is required',
                'articleCode.required' => 'Article Code field is required',
                'brand.required' => 'Select Brand field is required',
                'metaTitle.required' => 'Enter Meta Title field is required',
                'productType.required' => 'Enter product type field is required',
                'metaDescription.required' => 'Enter Meta Description field is required',
                'filter.required' => 'Select filter field is required',
                'stock.required' => 'Stock field is required.',
                'price.required' => 'Enter Price field is required',
                'tags.required' => 'Tags field is required',
                'material.required' => 'Fabric/Material field is required',
                'discount.required' => 'Enter Discount field is required',
                'productStatus.required' => 'Status field is required',
                'gender.required' => 'Gender field is required',
            ]
        );
        $updateproduct = Products::find($id);
        // dd($updateproduct);
        // updatin the discounted price on base of changed/updated price and discount value..
        $discount = $request->discount; // fetched the discount value 
        $price = $request->price; // fetched the original price entered 

        $discountedPrice = ($price * $discount) / 100;
        if ($updateproduct->actualPrice == $request->price) {
            $updateproduct->discountedPrice = $updateproduct->discountedPrice;
        } else {
            $Calculated = $price - $discountedPrice;
            $updateproduct->discountedPrice = $Calculated;
        }

        $updateproduct->name = $request->productname;


        $updateproduct->name = $request->productname;
        $updateproduct->description = $request->productDescription;
        $updateproduct->articleCode = $request->articleCode; //adding article code in db
        $updateproduct->brand = $request->brand; // adding brand value in db
        $updateproduct->barcode = $request->barcode;
        $updateproduct->metaTitle = $request->metaTitle;
        $updateproduct->metaDescription = $request->metaDescription;
        $updateproduct->productType = $request->productType;
        $updateproduct->actualprice = $request->price;
        $updateproduct->gender = $request->gender; // adding gender field into db
        $updateproduct->material = $request->material; //adding material field in db
        $updateproduct->discount = $request->discount;
        $updateproduct->status = $request->productStatus;
        $updateproduct->stock = $request->stock;
        if ($request->has('productHighlight')) {
            $updateproduct->highlight = $request->productHighlight;
        }
        if ($request->has('additionalInfo')) {
            $updateproduct->additional_information = $request->additionalInfo;
        }

        // dd($updateproduct);

        $updateproduct->save();

        if ($files = $request->file('productthumbnail')) {
            foreach ($files as $file) {
                $extension =     $file->getClientOriginalExtension();
                $filename = time() . '-' . uniqid() . '.' . $extension;
                $file->move(public_path('/ProductThumbnail'), $filename);

                $newImage = new Image();
                $newImage->name = $filename;
                $newImage->product_id = $updateproduct->id;
                $newImage->save();
            }
        }

        if ($request->has('productCategory')) {
            $updateproduct->products_category()->sync($request->productCategory); // for storing multiple select category using pivot table.
        }
        if ($request->has('filter')) {
            $updateproduct->filters()->sync($request->filter); //updating the filter category in edit product page.
        }
        if ($request->has('suitable')) {
            $updateproduct->suitableFor()->sync($request->suitable);
        }
        if ($request->has('tags')) {
            $updateproduct->tags()->sync($request->tags);
        }

        if ($request->ajax()) {
            return response()->json([
                'message' => 'Product details has been added..',
                'redirect_url' => route('manage.product')
            ]);
        }

        return redirect()->route('manage.product')->with('productUpdated', 'Product details has been updated.');
    }
    public function delete($id)
    {
        $product = Products::find($id);
        // dd($product);
        $product->delete();
        return redirect()->route('manage.product')->with('deleted', 'Item has been deleted');
    }
}

<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Color;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Products;
use App\Models\ProductType;
use App\Models\Variant;
use App\Models\VariantImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Razorpay\Api\Product;
use Surfsidemedia\Shoppingcart\Facades\Cart as Cart;


class HomeController extends Controller
{
    public function index()
    {
        // $categories = Category::with('subcategory')->whereNull('parent_id')->get();//gives you mens wear womens wear kids wear 
        // // dd($categories);
        // $categoryData = Category::with('subcategory')->has('subcategory')->get(); // gets all the data in category table with relation array //used it for api testing**
        // // dd($categoryData);
        $mensCategory = Category::with('subcategory.subcategory')
            ->where('name', 'Menswear')
            ->whereNull('parent_id')
            ->get();
        $womensCategory = Category::with('subcategory.subcategory')
            ->where('name', 'WomensWear')
            ->whereNull('parent_id')
            ->get();
        // dd($womensCategory);
        $kidsCategory = Category::with('subcategory.subcategory')
            ->where('name', 'Kidswear')
            ->whereNull('parent_id')
            ->get();

        $allProducts = Products::limit(7)->with([
            'products_category',
            'firstVariantImage',
            'firstVariant'
        ])->get();
        // dd($allProducts);
        $singleProduct =  Products::with([
            'products_category',
            'firstVariantImage',
            'firstVariant'
        ])->first();
        // dd($singleProduct);

        return view('frontend.home', compact('allProducts', 'singleProduct', 'mensCategory', 'womensCategory', 'kidsCategory'));
    }
    public function shop()
    {
        //these are for header navbar
        $categorydata = Category::with('products')->get();

        $mensCategory = Category::with('subcategory.subcategory')
            ->where('name', 'Menswear')
            ->whereNull('parent_id')
            ->get();
        $womensCategory = Category::with('subcategory.subcategory')
            ->where('name', 'WomensWear')
            ->whereNull('parent_id')
            ->get();
        // dd($womensCategory);
        $kidsCategory = Category::with('subcategory.subcategory')
            ->where('name', 'Kidswear')
            ->whereNull('parent_id')
            ->get();

        //product data 
        $allProducts = Products::with([
            'products_category',
            'firstVariantImage',
            'firstVariant'
        ])->paginate(6);

        // cart data to show in side cart menu  
        $cartdata = Cart::content();
        $total = Cart::total();
        $subtotal = Cart::subtotal();
        $tax = Cart::tax();
        $count = Cart::count();

        // dd($cartdata);

        // dd($allProducts);

        $producttype = ProductType::all();

        $colordata = Color::all();
        // dd($colordata);
        return view('frontend.shop', compact(
            'allProducts',
            // cart data starts here 
            'cartdata',
            'total',
            'subtotal',
            'tax',
            'count',
            // cartdata ends here
            'producttype',
            'colordata',
            'categorydata',
            'mensCategory',
            'womensCategory',
            'kidsCategory'
        ));
    }

    public function productDetails($product_id, $color_id = null)
    {
        $product = Products::with('products_category')->find($product_id);
        // dd($product);
        $type = ProductType::find($product->productType);

        $variantdata = Variant::with('color')
            ->where('product_id', $product_id)
            ->get();
        // dd($variantdata);

        $sizedata = collect();

        if ($color_id) {
            foreach ($variantdata as $variant) {
                if ($variant->color && $variant->color->id == $color_id) {
                    $sizedata->push($variant->size);
                }
            }

            // Find the selected color variant for display
            $selectedColor = $variantdata->first(function ($variant) use ($color_id) {
                return $variant->color && $variant->color->id == $color_id;
            });
        } else {
            // Default to first variant if no color_id is passed
            $selectedColor = $variantdata->first();
        }

        // dd($product->firstVariant);
        // dd($selectedColor);
        // dd($sizedata);

        $variantImage = VariantImage::where('product_id', $product_id)
            ->when($color_id, fn($query) => $query->where('color_id', $color_id))
            ->get();

        return view('frontend.product_details', compact(
            'product',
            'sizedata',
            'type',
            'selectedColor',
            'variantdata',
            'variantImage',
            'color_id'
        ));
    }



    public function getProducts($category_id)
    {
        $products = Products::whereHas('products_category', function ($query) use ($category_id) {
            $query->where('category.id', $category_id);
        })
            ->with(['firstVariantImage', 'firstVariant'])
            ->get();




        if (request()->ajax()) {
            $html = view('frontend.filteredProducts', compact('products'))->render();
            return response()->json(['html' => $html]);
        } else {
            return view('frontend.filteredProducts', compact('products'));
        }
    }
    // public function getProductsOnColor(Request $request)
    // {
    //     $category_id = $request->input('category_id');
    //     $color_ids = $request->input('color_ids');

    //     // Start with a base query
    //     $query = Products::whereHas('products_category', function ($query) use ($category_id) {
    //         $query->where('parent_id', $category_id);
    //     });

    //     // If color IDs are present, filter the products
    //     if (!empty($color_ids)) {
    //         $query->whereHas('firstVariant', function ($subQuery) use ($color_ids) {
    //             $subQuery->whereIn('color_id', $color_ids);
    //         });
    //     }

    //     $products = $query->with('firstVariantImage')
    //         ->with('firstVariant')
    //         ->get();

    //     if (request()->ajax()) {
    //         $html = view('frontend.colorFilteredProducts', compact('products'))->render();
    //         return response()->json(['html' => $html]);
    //     } else {
    //         return view('frontend.filteredProducts', compact('products'));
    //     }
    // }
    public function getProductsOnColor(Request $request)
    {
        $color_ids = $request->input('color_ids', []);

        // Start with all products
        $query = Products::query();

        // If color IDs are present, filter the products
        if (!empty($color_ids)) {
            $query->whereHas('firstVariant', function ($subQuery) use ($color_ids) {
                $subQuery->whereIn('color_id', $color_ids);
            });
        }

        $products = $query->with(['firstVariantImage', 'firstVariant'])->get();

        if ($request->ajax()) {
            $html = view('frontend.colorFilteredProducts', compact('products'))->render();
            return response()->json(['html' => $html]);
        }

        return view('frontend.filteredProducts', compact('products'));
    }

    public function menswear()
    {

        $categorydata = Category::with('products')->get();
        $producttype = ProductType::all();

        $mensCategory = Category::with('subcategory.subcategory')
            ->where('name', 'Menswear')
            ->whereNull('parent_id')
            ->get();
        $womensCategory = Category::with('subcategory.subcategory')
            ->where('name', 'WomensWear')
            ->whereNull('parent_id')
            ->get();
        // dd($womensCategory);
        $kidsCategory = Category::with('subcategory.subcategory')
            ->where('name', 'Kidswear')
            ->whereNull('parent_id')
            ->get();
        // this is for the navbar end


        $menswear = Products::whereHas('products_category', function ($query) {
            $query->where('parent_id', 1);
        })->with(['firstVariant', 'firstVariantImage'])->get();

        $colordata = Color::all();

        // $imagedata = VariantImage::where();
        // dd($menswear);

        return view('frontend.shopMensWear', compact('menswear', 'categorydata', 'producttype', 'mensCategory', 'womensCategory', 'kidsCategory', 'colordata'));
    }
    public function womenswear()
    {
        $categorydata = Category::with('products')->get();
        // dd($categorydata);

        $producttype = ProductType::all();


        $mensCategory = Category::with('subcategory.subcategory')
            ->where('name', 'Menswear')
            ->whereNull('parent_id')
            ->get();
        $womensCategory = Category::with('subcategory.subcategory')
            ->where('name', 'WomensWear')
            ->whereNull('parent_id')
            ->get();
        // dd($womensCategory);
        $kidsCategory = Category::with('subcategory.subcategory')
            ->where('name', 'Kidswear')
            ->whereNull('parent_id')
            ->get();
        // this is for the navbar end
        $womenswear = Products::whereHas('products_category', function ($query) {
            $query->where('parent_id', 2);
        })->with(['firstVariant', 'firstVariantImage'])
            ->get();
        // $womenswear = Products::with('products_Category')->get();//this will fetch all of the products

        // dd($womenswear);
        $colordata = Color::all();
        // dd($colordata);

        return view('frontend.shopWomensWear', compact('womenswear', 'producttype', 'categorydata', 'mensCategory', 'womensCategory', 'kidsCategory', 'colordata'));
    }
    public function kidswear()
    {
        $categorydata = Category::all();
        $producttype = ProductType::all();


        $mensCategory = Category::with('subcategory.subcategory')
            ->where('name', 'Menswear')
            ->whereNull('parent_id')
            ->get();
        $womensCategory = Category::with('subcategory.subcategory')
            ->where('name', 'WomensWear')
            ->whereNull('parent_id')
            ->get();
        // dd($womensCategory);
        $kidsCategory = Category::with('subcategory.subcategory')
            ->where('name', 'Kidswear')
            ->whereNull('parent_id')
            ->get();

        $colordata = Color::all();

        $kidswear = Products::whereHas('products_category', function ($query) {
            $query->where('parent_id', 3);
        })->with(['firstVariant', 'firstVariantImage'])
            ->get();

        // dd($kidswear);
        if ($kidswear->isEmpty()) {
            return view('frontend.errorPage');
        } else {
            return view('frontend.shopKidsWear', compact('kidswear', 'producttype', 'categorydata', 'mensCategory', 'womensCategory', 'kidsCategory', 'colordata'));
        }
    }

    public function accessories()
    {
        $categorydata = Category::all();
        $producttype = ProductType::all();


        $mensCategory = Category::with('subcategory.subcategory')
            ->where('name', 'Menswear')
            ->whereNull('parent_id')
            ->get();
        $womensCategory = Category::with('subcategory.subcategory')
            ->where('name', 'WomensWear')
            ->whereNull('parent_id')
            ->get();
        // dd($womensCategory);
        $kidsCategory = Category::with('subcategory.subcategory')
            ->where('name', 'Kidswear')
            ->whereNull('parent_id')
            ->get();
        $accessories = Products::whereHas('products_category', function ($query) {
            $query->where('productType', 3);
        })->get();

        // dd($accessories);

        if ($accessories->isEmpty()) {
            return view('frontend.errorPage');
        } else {
            return view('frontend.shopAccessories', compact('accessories', 'producttype', 'categorydata', 'mensCategory', 'womensCategory', 'kidsCategory'));
        }
    }
    public function vieworders()
    {
        $user = Auth::user();
        $orders = Order::where('user_id', $user->email)->get();
        // dd($orders);
        return view('frontend.viewOrders', compact('orders'));
    }

    public function vieworderdetails($order_id)
    {
        $order = Order::find($order_id);

        $orderdetails = OrderItem::where('order_id', $order_id)->get();

        // Extract product IDs from order details
        $productIds = $orderdetails->pluck('product_id')->toArray();

        // Fetch products based on extracted IDs
        $products = Products::whereIn('id', $productIds)
            ->with('firstVariant')
            ->with('firstVariantImage')
            ->get();

        $variants = Variant::whereIn('product_id', $productIds)->with('color')->get();

        $variantImages = VariantImage::whereIn('product_id', $productIds)->get();
        // dd($variantImages);
        return view('frontend.viewOrderDetails', compact('order', 'orderdetails', 'products', 'variants', 'variantImages'));
    }

    public function errorpage()
    {
        return view('frontend.errorPage');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Products;
use Illuminate\Http\Request;

class ManageOrderController extends Controller
{
    public function index(){
        $orderData = Order::all();

        // dd($orderData);
        
        return view('admin.orders.orderDetails',compact('orderData'));

    }


    public function orderdetails($id){
        $orderdetails = Order::find($id);
        // dd($orderdetails);
          $orderdetails = OrderItem::where('order_id', $id)->get();
        // dd($orderdetails);
        // Extract product IDs from order details
        $productIds = $orderdetails->pluck('product_id')->toArray();

        // Fetch products based on extracted IDs
        $products = Products::whereIn('id', $productIds)
            ->with('firstVariant')
            ->with('firstVariantImage')
            ->get();

        return view('admin.orders.viewOrderDetails',compact('orderdetails','products','orderdetails'));
    }
    
}

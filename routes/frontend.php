<?php

use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\HomeController;
use Illuminate\Support\Facades\Route;

//Frontend related routes...
Route::get('/', [HomeController::class, 'index'])->name('home');

//product list 
Route::get('/product-list', [HomeController::class, 'shop'])->name('product.list');

//filtering the products based on mens womens and kids wear

Route::get('/product-list/menswear', [HomeController::class, 'menswear'])->name('menswear.product.list');
Route::get('/product-list/womenswear', [HomeController::class, 'womenswear'])->name('womenswear.product.list');
Route::get('/product-list/kidswear', [HomeController::class, 'kidswear'])->name('kidswear.product.list');
Route::get('/product-list/accessories', [HomeController::class, 'accessories'])->name('accessories.product.list');

Route::get('/404', [HomeController::class, 'errorpage'])->name('not.found');

//specific product detail.
// Route::get('/product-details/{product_id}', [HomeController::class, 'productDetails'])->name('product.details');
Route::get('/product-details/{product_id}/{color_id?}', [HomeController::class, 'productDetails'])->name('product.details');

//filtering the products 

Route::get('product-list/get-filtered-products/{category_id}', [HomeController::class, 'getProducts'])->name('get.products');
Route::get('product-list/get-color-filtered-products', [HomeController::class, 'getProductsOnColor'])->name('get.color.products');

//checkout related pages 
Route::get('quick-add/{product_id}', [CheckoutController::class, 'quickadd'])->name('quick.add');

Route::get('/cart', [CheckoutController::class, 'cart'])->name('cart.page'); // for viewing cart
Route::get('add-to-cart/{product_id}/{color_id}/{size}', [CheckoutController::class, 'addToCart'])->name('add.to.cart'); // for adding item in cart.
Route::get('/remove-item/{rowId}', [CheckoutController::class, 'delete'])->name('remove.from.cart'); // removing item in the cart.
Route::post('/cart/update-qty', [CheckoutController::class, 'updateCartQty'])->name('cart.update.qty');

Route::get('/view-orders', [HomeController::class, 'vieworders'])->name('view.order');
Route::get('/view-order-details/{order_id}',[HomeController::class, 'vieworderdetails'])->name('view.order.details');

// checkout related pages (protected by login)
Route::middleware(['isUser'])->group(function () {

    Route::get('/cart/checkout', [CheckoutController::class, 'checkout'])->name('checkout.page');
    Route::post('/create-order/payment/razorpay', [CheckoutController::class, 'razorpay'])->name('payment.gateway');
    Route::post('/create-order/payment/razorpay-success', [CheckoutController::class, 'paymentSuccess'])->name('razorpay.order.payment');
    Route::get('/order-confirmation', [CheckoutController::class, 'ordersuccessMsg'])->name('order.success.page');
});

// Route::get('/cart/checkout',[CheckoutController::class, 'checkout'])->name('checkout.page');

// Route::post('/create-order',[CheckoutController::class,'createorder'])->name('create.order');

// Route::get('/order-confirmation',[CheckoutController::class, 'ordersuccessMsg'])->name('order.success');
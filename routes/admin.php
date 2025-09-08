<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ChangePasswordController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\OrderListingController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\FilterController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\HandleActionController;
use App\Http\Controllers\Admin\ManageHsnController;
use App\Http\Controllers\Admin\ManageImageVarient;
use App\Http\Controllers\Admin\ManageOrderController;
use App\Http\Controllers\Admin\ManageSuitableForController;
use App\Http\Controllers\Admin\ManageTagsController;
use App\Http\Controllers\Admin\ManageTaxController;
use App\Http\Controllers\Admin\ManageVarientController;
use App\Http\Controllers\Admin\OrderDetailsController;
use App\Http\Controllers\Admin\ProductTypeController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('/admin',[LoginController::class , 'index'])->name('admin.login');
Route::post('/admin/login',[LoginController::class , 'verifyLogin'])->name('verify.login');

Route::get('/admin/logout',[LoginController::class , 'adminLogout'])->name('admin.logout');

Route::group(['prefix'=>'/admin', 'middleware'=>['isAdmin']],function(){
    Route::get('/dashboard',[DashboardController::class, 'index'])->name('admin.dashboard');
    //managing th eproducts listed

    Route::get('/manage-product',[ProductController::class , 'index'])->name('manage.product');
    Route::get('/add-product',[ProductController::class , 'show'])->name('add.product.page');
    Route::post('/add-new-product',[ProductController::class , 'store'])->name('add.new.product');
    Route::get('/edit-product/{id}',[ProductController::class , 'edit'])->name('edit.product');
    Route::post('/edit-product/{id}',[ProductController::class , 'update'])->name('submit.edit.product');
    Route::get('/delete-product/{id}',[ProductController::class , 'delete'])->name('delete.product');
    //Managing the category 

    Route::get('/manage-category',[CategoryController::class ,'index'])->name('manage.category');
    Route::get('/add-category',[CategoryController::class ,'show'])->name('add.category.page');
    Route::post('/add-new-category',[CategoryController::class ,'storeCategory'])->name('add.new.category');
    Route::get('/edit-category/{id}',[CategoryController::class ,'edit'])->name('edit.category');
    Route::post('/edit-category/{id}',[CategoryController::class ,'updateCategory'])->name('submit.edit.category');
    Route::get('/delete-category/{id}',[CategoryController::class ,'delete'])->name('delete.category');
    //hnadling change of password 
    Route::get('/change-password',[ChangePasswordController::class, 'index'])->name('admin.change.password');
    Route::post('/update-password',[ChangePasswordController::class, 'update'])->name('admin.update.password');
    //filter Crud
    Route::get('/manage-filter',[FilterController::class , 'index'])->name('manage.filter');
    Route::get('/add-filter',[FilterController::class , 'show'])->name('add.filter');
    Route::post('/add-new-filter',[FilterController::class , 'store'])->name('add.new.filter');
    Route::get('/edit-filter/{id}',[FilterController::class , 'edit'])->name('edit.filter');
    Route::post('/update-filter/{id}',[FilterController::class , 'update'])->name('update.filter');
    Route::get('/delete-filter/{id}',[FilterController::class , 'delete'])->name('delete.filter');
    //color crud

    Route::get('/manage-color',[ColorController::class , 'index'])->name('manage.color');
    Route::get('/add-color',[ColorController::class , 'show'])->name('add.color');
    Route::post('/add-new-color',[ColorController::class , 'store'])->name('add.new.color');
    Route::get('/edit-color/{id}',[ColorController::class , 'edit'])->name('edit.color');
    Route::post('/update-color/{id}',[ColorController::class , 'update'])->name('update.color');
    Route::get('/delete-color/{id}',[ColorController::class , 'delete'])->name('delete.color');
    // Product type crud


    Route::get('/manage-product-type',[ProductTypeController::class , 'index'])->name('manage.types');
    Route::get('/add-product-type',[ProductTypeController::class , 'show'])->name('add.types');
    Route::post('/add-new-product-type',[ProductTypeController::class , 'store'])->name('add.new.types');
    Route::get('/edit-product-type/{id}',[ProductTypeController::class , 'edit'])->name('edit.types');
    Route::post('/update-product-type/{id}',[ProductTypeController::class , 'update'])->name('update.types');
    Route::get('/delete-product-type/{id}',[ProductTypeController::class , 'delete'])->name('delete.types');

    //handling the images button
    //showing the images which were uploaded without making the variants
    // Route::get('/view-all-images/{id}',[HandleActionController::class, 'viewImage'])->name('view.image');
    // Route::get('/handle-image/{id}',[HandleActionController::class, 'handleImages'])->name('handle.image');
    // Route::post('/update-image/{id}',[HandleActionController::class, 'updateImages'])->name('update.image');
    // Route::get('/delete-image/{id}',[HandleActionController::class, 'deleteImage'])->name('delete.image');

    // MAnage Suitable for
    Route::get('/manage-suitable-for',[ManageSuitableForController::class, 'index'])->name('manage.suitable.for');
    Route::get('/add-suitable-for',[ManageSuitableForController::class, 'add'])->name('add.suitable.for');
    Route::post('/new-suitable-for',[ManageSuitableForController::class, 'store'])->name('new.suitable.for');
    Route::get('/suitable-for/edit/{id}',[ManageSuitableForController::class, 'edit'])->name('edit.suitable.for');
    Route::post('/suitable-for/update/{id}',[ManageSuitableForController::class, 'update'])->name('update.suitable.for');

    // manage tags
    Route::get('/manage-tags',[ManageTagsController::class,'index'])->name('manage.tags');
    Route::get('/add-tags',[ManageTagsController::class,'show'])->name('add.tags');
    Route::post('/add-new-tags',[ManageTagsController::class,'store'])->name('add.new.tags');
    Route::get('/manage-tags/edit/{id}',[ManageTagsController::class,'edit'])->name('edit.tags');
    Route::post('/manage-tags/edit/update/{id}',[ManageTagsController::class,'update'])->name('update.tags');

    //manage HSN
    Route::get('/manage-hsn',[ManageHsnController::class, 'index'])->name('manage.hsn');
    Route::get('/add-new-hsn',[ManageHsnController::class, 'show'])->name('add.hsn');
    Route::post('/new-hsn',[ManageHsnController::class, 'store'])->name('new.hsn');
    Route::get('/edit-hsn/{id}',[ManageHsnController::class, 'edit'])->name('edit.hsn');
    Route::post('/update-hsn/{id}',[ManageHsnController::class, 'update'])->name('update.hsn');
    // manage Gst slab rate
    Route::get('/manage-gst-slab-rate',[ManageTaxController::class, 'index'])->name('manage.tax');
    Route::get('/add-new-tax-slab',[ManageTaxController::class, 'show'])->name('add.tax.slab');
    Route::post('/add-tax-slab',[ManageTaxController::class, 'store'])->name('add.new.tax.slab');
    Route::get('/edit-tax-slab/{id}',[ManageTaxController::class, 'edit'])->name('edit.tax.slab');
    Route::post('/update-tax-slab/{id}',[ManageTaxController::class, 'update'])->name('update.tax.slab');
    //Manage orders on admin panel 
    Route::get('/manage-orders',[ManageOrderController::class,'index'])->name('manage.orders');
    // Route::get('/delete-order/{id}',[ManageOrderController::class,'delete'])->name('delete.order');
    Route::get('/view-order-details/{id}',[ManageOrderController::class,'orderdetails'])->name('order.details');
    //manage product varient
    Route::get('/add-product-varient/{id}',[ManageVarientController::class, 'index'])->name('add.varient');
    Route::post('/add-new-varient/{id}',[ManageVarientController::class, 'addVarient'])->name('add.new.varient');
    Route::get('/manage-all-varient/{id}',[ManageVarientController::class, 'manage'])->name('manage.varient');
    Route::get('/edit-product-varient/{variant_id}/{product_id}',[ManageVarientController::class, 'edit'])->name('edit.varient');
    Route::post('/update-product-varient/{variant_id}/{product_id}',[ManageVarientController::class, 'update'])->name('update.varient');
    // handling image varient 
    Route::get('/manage-variant-images/{id}',[ManageImageVarient::class, 'viewImage'])->name('manage.variant.image');
    Route::get('/add-variant-image/{id}',[ManageImageVarient::class,'index'])->name('image.variant');
    Route::post('/add-new-variant-image/{id}',[ManageImageVarient::class,'updateImages'])->name('add.image.variant');
    Route::get('/edit-variant-image/{color_id}/{product_id}',[ManageImageVarient::class,'edit'])->name('edit.image.variant');
    Route::post('/update-variant-image/{color_id}/{product_id}',[ManageImageVarient::class,'submit'])->name('update.image.variant');
    Route::get('/delete-variant-image/{color_id}/{product_id}',[ManageImageVarient::class,'delete'])->name('delete.image.variant');

});



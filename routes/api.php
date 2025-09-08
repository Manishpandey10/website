<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\FilterController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\ManageImageVarient;
use App\Http\Controllers\Admin\ManageVarientController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductTypeController;
use App\Http\Controllers\users\SignupController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });



// Route::post('/login', [LoginController::class, 'verifyLogin'])->name('verify.login');
// Route::get('/logout',[LoginController::class , 'adminLogout'])->name('admin.logout');

// Route::post('/user/register', [SignupController::class, 'registerUser'])->name('register.new.user');

Route::middleware(['auth:sanctum'])->group(function () {
    // Route::get('/manage-category', [CategoryController::class, 'index'])->name('manage.category');
    // Route::get('/manage-product', [ProductController::class, 'index'])->name('manage.product');
    // Route::get('/manage-filter',[FilterController::class , 'index'])->name('manage.filter');
    // Route::get('/manage-product-type',[ProductTypeController::class , 'index'])->name('manage.types');
    // Route::get('/manage-all-varient/{id}',[ManageVarientController::class, 'manage'])->name('manage.varient');

    // Route::get('/manage-variant-images/{id}',[ManageImageVarient::class, 'viewImage'])->name('manage.variant.image');

});


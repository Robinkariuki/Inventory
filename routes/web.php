<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[ProductController::class,'index'])->name('product.index');

//show create product form
Route::get('/product/create',[ProductController::class,'createProduct']);
// store product data
Route::post('/product',[ProductController::class,'storeProductData']);



Route::get('/getDataTableData',[ProductController::class,'getDataTableData'])->name('getDataTableData');
Route::post('/getProductData',[ProductController::class,'getProductData'])->name('getProductData');
Route::post('/updateProduct',[ProductController::class,'updateProduct'])->name('updateProduct');
Route::post('/deleteProduct',[ProductController::class,'deleteProduct'])->name('deleteProduct');

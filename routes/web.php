<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

// Route::get('/', function () {
//     return view('home');
// });

Auth::routes();

Route::fallback(function () {
    return response()->view('error.400',[],400);
});

Route::get('/', [App\Http\Controllers\Controller::class, 'index'])->name('index');
Route::get('/home', [App\Http\Controllers\Controller::class, 'index'])->name('index');
Route::get('/companyinfo', [App\Http\Controllers\Controller::class, 'companyinfo'])->name('companyinfo');
Route::get('/news', [App\Http\Controllers\Controller::class, 'news'])->name('news');
Route::get('/news/{type}/page/{now_page}', [App\Http\Controllers\Controller::class, 'news_page'])->name('news_page');
Route::get('/news/detail/{id}', [App\Http\Controllers\Controller::class, 'news_detail'])->name('news_detail');
Route::get('/products/display/', [App\Http\Controllers\Controller::class, 'products_display_all'])->name('products_display_all');
Route::get('/product/detail/{id}', [App\Http\Controllers\Controller::class, 'product_detail'])->name('product_detail');


Route::get('/management/companyinfo/edit',[App\Http\Controllers\HomeController::class, 'companyinfo_edit'])->name('companyinfo_edit');
Route::post('/management/companyinfo/update/{id}',[App\Http\Controllers\HomeController::class, 'companyinfo_update'])->name('companyinfo_update');
Route::get('/management/companyinfo/header',[App\Http\Controllers\HomeController::class, 'header_edit'])->name('header_edit');
Route::post('/management/companyinfo/header/store',[App\Http\Controllers\HomeController::class, 'header_store'])->name('header_store');
Route::post('/management/companyinfo/header/delete/{id}',[App\Http\Controllers\HomeController::class, 'header_delete'])->name('header_delete');

Route::get('/management/homecarousel', [App\Http\Controllers\HomeController::class, 'homecarousel'])->name('homecarousel');
Route::get('/management/homecarousel/add', [App\Http\Controllers\HomeController::class, 'homecarousel_add'])->name('homecarousel_add');
Route::post('/management/homecarousel/store',[App\Http\Controllers\HomeController::class, 'homecarousel_store'])->name('homecarousel_store');
Route::get('/management/homecarousel/edit/{id}',[App\Http\Controllers\HomeController::class, 'homecarousel_edit'])->name('homecarousel_edit');
Route::post('/management/homecarousel/update/{id}',[App\Http\Controllers\HomeController::class, 'homecarousel_update'])->name('homecarousel_update');
Route::post('/management/homecarousel/delete/{id}',[App\Http\Controllers\HomeController::class, 'homecarousel_delete'])->name('homecarousel_delete');
Route::get('/management/homecarousel/order',[App\Http\Controllers\HomeController::class, 'homecarousel_order'])->name('homecarousel_order');
Route::post('/management/homecarousel/order/update',[App\Http\Controllers\HomeController::class, 'homecarousel_orderupdate'])->name('homecarousel_orderupdate');


Route::get('/management/newsposts',[App\Http\Controllers\HomeController::class, 'newsposts'])->name('newsposts');
Route::get('/management/newsposts/add',[App\Http\Controllers\HomeController::class, 'newsposts_add'])->name('newsposts_add');
Route::post('/management/newsposts/store',[App\Http\Controllers\HomeController::class, 'newsposts_store'])->name('newsposts_store');
Route::get('/management/newsposts/edit/{id}',[App\Http\Controllers\HomeController::class, 'newsposts_edit'])->name('newsposts_edit');
Route::post('/management/newsposts/update/{id}',[App\Http\Controllers\HomeController::class, 'newsposts_update'])->name('newsposts_update');
Route::post('/management/newsposts/delete/{id}',[App\Http\Controllers\HomeController::class, 'newsposts_delete'])->name('newsposts_delete');

Route::get('/management/homeposts', [App\Http\Controllers\HomeController::class, 'homeposts'])->name('homeposts');
Route::get('/management/homeposts/select', [App\Http\Controllers\HomeController::class, 'homeposts_select'])->name('homeposts_select');
Route::get('/management/homeposts/add/{post_type}', [App\Http\Controllers\HomeController::class, 'homeposts_add'])->name('homeposts_add');
Route::post('/management/homeposts/store',[App\Http\Controllers\HomeController::class, 'homeposts_store'])->name('homeposts_store');
Route::get('/management/homeposts/edit/{id}',[App\Http\Controllers\HomeController::class, 'homeposts_edit'])->name('homeposts_edit');
Route::post('/management/homeposts/update/{id}',[App\Http\Controllers\HomeController::class, 'homeposts_update'])->name('homeposts_update');
Route::post('/management/homeposts/delete/{id}',[App\Http\Controllers\HomeController::class, 'homeposts_delete'])->name('homeposts_delete');
Route::get('/management/homeposts/order',[App\Http\Controllers\HomeController::class, 'homeposts_order'])->name('homeposts_order');
Route::post('/management/homeposts/order/update',[App\Http\Controllers\HomeController::class, 'homeposts_orderupdate'])->name('homeposts_orderupdate');

Route::get('/management/products_types', [App\Http\Controllers\HomeController::class, 'products_types'])->name('products_types');
Route::get('/management/products_types/add', [App\Http\Controllers\HomeController::class, 'products_types_add'])->name('products_types_add');
Route::post('/management/products_types/store',[App\Http\Controllers\HomeController::class, 'products_types_store'])->name('products_types_store');
Route::get('/management/products_types/edit/{id}',[App\Http\Controllers\HomeController::class, 'products_types_edit'])->name('products_types_edit');
Route::post('/management/products_types/update/{id}',[App\Http\Controllers\HomeController::class, 'products_types_update'])->name('products_types_update');
Route::post('/management/products_types/delete/{id}',[App\Http\Controllers\HomeController::class, 'products_types_delete'])->name('products_types_delete');

Route::get('/management/products', [App\Http\Controllers\HomeController::class, 'products'])->name('products');
Route::get('/management/products/add', [App\Http\Controllers\HomeController::class, 'products_add'])->name('products_add');
Route::post('/management/products/store',[App\Http\Controllers\HomeController::class, 'products_store'])->name('products_store');
Route::get('/management/products/edit/{id}',[App\Http\Controllers\HomeController::class, 'products_edit'])->name('products_edit');
Route::post('/management/products/update/{id}',[App\Http\Controllers\HomeController::class, 'products_update'])->name('products_update');
Route::post('/management/products/delete/{id}',[App\Http\Controllers\HomeController::class, 'products_delete'])->name('products_delete');

Route::get('/management/uploadimages',[App\Http\Controllers\HomeController::class, 'uploadimages'])->name('uploadimages');
Route::get('/management/uploadimages/from/{from}',[App\Http\Controllers\HomeController::class, 'uploadimages_from'])->name('uploadimages_from');
Route::post('/management/uploadimages/add',[App\Http\Controllers\HomeController::class, 'uploadimages_store'])->name('uploadimages_store');

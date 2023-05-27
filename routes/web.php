<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\AdminPanelController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/product', ProductController::class);
Route::get('/product_json-data/',[ProductController::class,'productDataJson'])->name('productDataJson');
Route::get('/product_json-data_search/{search}',[ProductController::class,'productDataJsonSearch'])->name('productDataJsonSearch');

// --------------------------------------------- Admin Panel --------------------------------------------------------

Route::get('admin-panel', [AdminPanelController::class,'dashboard']);

// --------------------------------------------- Admin Panel --------------------------------------------------------


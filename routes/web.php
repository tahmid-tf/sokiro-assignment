<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\AdminPanelController;
use App\Http\Controllers\QuantityController;

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
    return redirect()->route('dashboard');
});

Auth::routes(['register'=>false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware('auth')->group(function () {


    // --------------------------------------------- Product --------------------------------------------------------


    Route::resource('/product', ProductController::class);
    Route::get('/product_json-data/', [ProductController::class, 'productDataJson'])->name('productDataJson');
    Route::get('/product_json-data_search/{search}', [ProductController::class, 'productDataJsonSearch'])->name('productDataJsonSearch');


// --------------------------------------------- Product --------------------------------------------------------


// --------------------------------------------- Quantity --------------------------------------------------------

    Route::resource('/quantity', QuantityController::class);

    Route::get('/quantity_json-data/', [QuantityController::class, 'quantityDataJson'])->name('quantityDataJson');
    Route::get('/quantity_json-data_search/{search}', [QuantityController::class, 'quantityDataJsonSearch'])->name('quantityDataJsonSearch');


// --------------------------------------------- Quantity --------------------------------------------------------


// --------------------------------------------- Admin Panel --------------------------------------------------------

    Route::get('admin-panel', [AdminPanelController::class, 'dashboard'])->name('dashboard');

// --------------------------------------------- Admin Panel --------------------------------------------------------

// --------------------------------------------- Logout --------------------------------------------------------

    Route::get('log_out', function (){
        \auth()->logout();
        return redirect()->route('home');
    })->name('log_out');

// --------------------------------------------- Logout --------------------------------------------------------


});



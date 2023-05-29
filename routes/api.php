<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\QuantityController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', [AuthController::class, 'user']);
    Route::post('logout', [AuthController::class, 'logout']);


    // --------------------------------------------- Product --------------------------------------------------------


    Route::resource('/product', ProductController::class)->except(['index', 'create', 'show', 'edit', 'update', 'destroy']);
    Route::get('/product_json-data/', [ProductController::class, 'productDataJson'])->name('productDataJson');
    Route::get('/product_json-data_search/{search}', [ProductController::class, 'productDataJsonSearch'])->name('productDataJsonSearch');


// --------------------------------------------- Product --------------------------------------------------------

    // --------------------------------------------- Quantity --------------------------------------------------------

    Route::resource('/quantity', QuantityController::class)->except(['index', 'create', 'show', 'edit', 'update', 'destroy']);;

    Route::get('/quantity_json-data/', [QuantityController::class, 'quantityDataJson'])->name('quantityDataJson');
    Route::get('/quantity_json-data_search/{search}', [QuantityController::class, 'quantityDataJsonSearch'])->name('quantityDataJsonSearch');


// --------------------------------------------- Quantity --------------------------------------------------------

});



//Route::resource('/product', ProductController::class);


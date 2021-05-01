<?php

use Illuminate\Http\Request;
use Illuminate\Support\Fcades\Routes;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;

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



//login_api
Route::Post('login',[LoginController::class, 'login']);
Route::Post('register',[LoginController::class, 'Register']);

//required apis of products
Route::Get('GetProducts',[ProductController::class, 'GetProducts']);
Route::Get('GetProductById',[ProductController::class, 'GetProductById']);

Route::Post('EntryProduct',[ProductController::class, 'InsertProduct']);
Route::Put('UpdateProduct',[ProductController::class, 'UpdateProduct']);


////required apis of product orders
Route::Get('GetOrders',[OrderController::class, 'GetOrders']);
Route::Post('EntryOrder',[OrderController::class, 'InsertOrder']);
Route::Post('UpdateOrderStatus',[OrderController::class, 'UpdateOrderStatus']);




Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
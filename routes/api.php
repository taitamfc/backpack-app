<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('sites',\App\Http\Controllers\Api\SiteController::class);
Route::apiResource('menu_items',\App\Http\Controllers\Api\MenuItemController::class);
Route::apiResource('events',\App\Http\Controllers\Api\EventController::class);
Route::apiResource('categories',\App\Http\Controllers\Api\CategoryController::class);
Route::apiResource('logs',\App\Http\Controllers\Api\LogController::class);
Route::apiResource('orders',\App\Http\Controllers\Api\OrderController::class);
<?php

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

Route::get('/', function () {
    return view('welcome');
});


// Custom route here
Route::group([
    'prefix' => config('backpack.base.route_prefix', 'admin'),
    'middleware' => ['web', config('backpack.base.middleware_key', 'admin')],
    'namespace' => 'App\Http\Controllers\Admin',
], function () {
    Route::get('syncs/{type?}',[\App\Http\Controllers\Admin\SyncController::class,'index'])->name('syncs.index');
    Route::get('syncs/sync/{id}',[\App\Http\Controllers\Admin\SyncController::class,'sync'])->name('syncs.sync');
    Route::post('syncs/syncAjax/{id}',[\App\Http\Controllers\Admin\SyncController::class,'syncAjax'])->name('syncs.syncAjax');
    Route::post('syncs/doSync',[\App\Http\Controllers\Admin\SyncController::class,'doSync'])->name('syncs.doSync');
    Route::resource('orders',\App\Http\Controllers\Admin\SiteOrderController::class);
    Route::resource('shippings',\App\Http\Controllers\Admin\SiteShippingController::class);
    Route::resource('products',\App\Http\Controllers\Admin\SiteProductController::class);
});

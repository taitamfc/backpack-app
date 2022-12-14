<?php

use Illuminate\Support\Facades\Route;

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('tag', 'TagCrudController');
    Route::crud('event', 'EventCrudController');
    Route::crud('order', 'OrderCrudController');
    Route::crud('category', 'CategoryCrudController');
    Route::crud('site', 'SiteCrudController');
    Route::crud('user', 'UserCrudController');
    Route::crud('page', 'PageCrudController');
    Route::crud('site-job', 'SiteJobCrudController');
}); // this should be the absolute last line of this file
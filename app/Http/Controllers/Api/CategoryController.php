<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(){
        $items = Category::all();
        foreach ($items as $item) {
            if( $item->seo_title == '' ){
                $item->seo_title = config('settings.product_cat_seo_title');
            }
            if( $item->seo_description == '' ){
                $item->seo_description = config('settings.product_cat_meta_description');
            }
        }
        return response()->json($items);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function index(){
        $items = Event::all();
        foreach ($items as $item) {
            if( $item->seo_title == '' ){
                $item->seo_title = config('settings.product_event_seo_title');
            }
            if( $item->seo_description == '' ){
                $item->seo_description = config('settings.product_event_meta_description');
            }
        }
        return response()->json($items);
    }
}

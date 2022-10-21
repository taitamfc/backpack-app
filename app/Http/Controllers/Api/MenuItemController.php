<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Backpack\MenuCRUD\app\Models\MenuItem;

class MenuItemController extends Controller
{
    public function index(){
        $items = MenuItem::getTree();
        return response()->json($items);
    }
}

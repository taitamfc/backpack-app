<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class LogController extends Controller
{
    public function store(Request $request)
    {
        $type = $request->type;
        $msg = $request->msg;
        switch ($type) {
            case 'info':
                Log::info($msg);
                break;
            case 'error':
                Log::error($msg);
                break;
            default:
                Log::info($msg);
                break;
        }
        return response()->json(['status'=>1]);
    }
}

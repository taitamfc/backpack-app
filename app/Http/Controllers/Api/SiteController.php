<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Site;
use App\Http\Resources\SiteResource;

class SiteController extends Controller
{
    public function index(Request $request)
    {
        $domain = $request->domain;
        $showAll = $request->showAll;
        $site = Site::where('site_domain',$domain)->first();
        if($showAll) {
            return response()->json($site);
        }
        return new SiteResource($site);
    }
    public function store(Request $request)
    {
        //
    }
    public function show($domain)
    {
        $site = Site::where('site_domain',$domain)->first();
        return new SiteResource($site);
        return response()->json($site);
    }
    public function update(Request $request, $id)
    {
        //
    }
    public function destroy($id)
    {
        //
    }  
}

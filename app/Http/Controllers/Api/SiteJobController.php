<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Site;
use App\Models\SiteJob;
use App\Http\Resources\SiteResource;

class SiteJobController extends Controller
{
    public function index(Request $request)
    {
        
    }
    public function store(Request $request)
    {
        
    }
    public function show(Request $request, $action)
    {
        switch ($action) {
            case 'list':
                $domain = $request->domain;
                $site = Site::where('site_domain',$domain)->firstOrFail();
                $items = SiteJob::where('status','waitting')
                ->where('site_id',$site->id)
                ->get();
                return response()->json($items);
                break;
            
            default:
            case 'update':
                $domain = $request->domain;
                $job_id = $request->job_id;
                $status = $request->status;
                $site = Site::where('site_domain',$domain)->firstOrFail();
                $item = SiteJob::where('id',$job_id)
                ->where('site_id',$site->id)
                ->firstOrFail();
                $item->status = $status;
                $item->save();
                return response()->json($item);
                break;
        }
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

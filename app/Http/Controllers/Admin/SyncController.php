<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SyncController extends Controller
{
    private $site = null;
    private $web_hook = 'https://__SITE_DOMAIN__/wp-admin/admin-ajax.php?action=LizadoCrm&controller=api&task=sync';
    public function syncAjax(Request $request,$site_id){
        $site = Site::find($site_id);
        $this->site = $site;
        $this->web_hook = str_replace('__SITE_DOMAIN__',$site->site_domain,$this->web_hook);

        $syncs = $request->syncs;
        $sync_position = session('sync_position', 0);
        $sync_type = $syncs[$sync_position];
        switch ($sync_type) {
            case 'init_settings':
                $res =  $this->sync_init_settings();
                break;
            
            default:
                # code...
                break;
        }
        $res['sync_type'] = $sync_type;
        $res['site_id'] = $site_id;
        return response()->json($res);
    }
    public function sync(Request $request,$site_id = 0){
        $synced_keys = $request->syncs ?? [];
        
        if(!$site_id){
            abort(404);
        }
        $site = Site::find($site_id);

        $syncs = [
            'init_settings' => 'Init Settings',
            'site_settings' => 'Site Settings',
            'menu_items'    => 'Menu Items',
            'pages'         => 'Pages',
            'events'        => 'Events',
            'categories'    => 'Categories',
        ];
        
        $params = [
            'site'      => $site,
            'site_id'   => $site_id,
            'syncs'     => $syncs,
            'synced_keys'  => $synced_keys,
        ];
        return view('admin.syncs.list',$params);
    }

    private function sync_init_settings(){
        $this->web_hook.= '&sync_type=init_settings';
        $response = Http::post($this->web_hook, [
            'web_hook' => $this->site->web_hook
        ]);
        dd($response);
        return [];
    }
}

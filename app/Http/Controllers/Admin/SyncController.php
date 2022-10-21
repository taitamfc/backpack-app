<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SyncController extends Controller
{
    private $site = null;
    private $web_hook = 'http://__SITE_DOMAIN__/wp-admin/admin-ajax.php?action=LizadoCrm&controller=api&task=sync&sync_type=';
    public function syncAjax(Request $request,$site_id){
        $site = Site::find($site_id);
        $this->site = $site;
        $this->web_hook = str_replace('__SITE_DOMAIN__',$site->site_domain,$this->web_hook);

        $syncs = $request->syncs;

        $sync_position = session('sync_position', 0);
        // $sync_position = 4;

        if( isset($syncs[$sync_position]) ){
            $sync_type = $syncs[$sync_position];
            switch ($sync_type) {
                case 'init_settings':
                    $res =  $this->sync_init_settings();
                    break;
                case 'site_settings':
                    $res =  $this->sync_type('site_settings');
                    break;
                case 'menu_items':
                    $res =  $this->sync_type('menu_items');
                    break;
                case 'pages':
                    $res =  $this->sync_pages();
                    break;                
                case 'events':
                    $res =  $this->sync_type('events');
                    break;                
                case 'categories':
                    $res =  $this->sync_type('categories');
                    break;                
                case 'assign_product_tags':
                    $res =  $this->sync_type('assign_product_tags');
                    break;                
                default:
                    # code...
                    break;
            }
            $sync_position++;
            session(['sync_position' => $sync_position]);
            $res['sync_type'] = $sync_type;
        }else{
            session(['sync_position' => 0]);
            $res['next_step'] = 0;
            $site->last_sync = date('Y-m-d H:i:s');
            $site->save();
        }
        
        $res['site_id'] = $site_id;
        $res['sync_position'] = $sync_position;
        return response()->json($res);
    }
    public function sync(Request $request,$site_id = 0){
        session(['sync_position' => 0]);
        $synced_keys = $request->syncs ?? [];
        
        if(!$site_id){
            abort(404);
        }
        $site = Site::find($site_id);

        $syncs = [
            'init_settings' => 'Init Settings',
            'site_settings' => 'Site Settings',
            'menu_items'    => 'Menu Items',
            // 'pages'         => 'Pages',
            'events'        => 'Events',
            'categories'    => 'Categories',
            'assign_product_tags'    => 'Assign Product Tags',
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
        $response = Http::asForm()->post($this->web_hook.'init_settings', [
            'web_hook' => $this->site->web_hook
        ]);
        return $response->json();
    }

    private function sync_type($type){
        $response = Http::get($this->web_hook.$type);
        echo($response);die();
        return $response->json();
    }

}

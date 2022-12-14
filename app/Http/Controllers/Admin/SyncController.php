<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Site;
use App\Models\SiteJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Jobs\SyncSiteEventJob;
use App\Jobs\SyncSiteCategoryJob;
use App\Jobs\SyncSiteJobsJob;

class SyncController extends Controller
{
    private $site = null;
    private $web_hook = 'https://__SITE_DOMAIN__/wp-admin/admin-ajax.php?action=LizadoCrm&controller=sync&task=sync&sync_type=';
    public function index(Request $request,$type = 'all'){
        $synced_sites = $request->syncs ?? [];

        $sites = Site::all();
        $params = [
            'type'      => $type,
            'sites'      => $sites,
            'synced_sites'  => $synced_sites,
        ];
        return view('admin.syncs.index',$params);
    }

    public function doSync(Request $request){
        $sync_type  = $request->type;
        $site_ids   = $request->syncs;
        foreach( $site_ids as $site_id ){
            $this->syncASite($site_id,$sync_type);
        }
        $res['next_step'] = 0;
        $res['status'] = 1;
        $res['msg'] = 'Added to queue';
        return response()->json($res);
    }

    private function syncASite($site_id,$sync_type){
        $site = Site::find($site_id);
        if( $sync_type == 'site-job' ){
            $this->site     = $site;
            $this->web_hook = str_replace('__SITE_DOMAIN__',$site->site_domain,$this->web_hook);
            $this->sync_init_settings();
            dispatch(new SyncSiteJobsJob($this->site,'jobs',$this->web_hook));
            return true;
        }
        $data = [
            'site_id'   => $site_id,
            'name'      => 'Sync '.$sync_type,
            'type'      => 'Sync'.ucfirst($sync_type),
            'status'    => 'waitting'
        ];
        $SiteJobObj = SiteJob::updateOrCreate([
            'site_id' => $site_id,
            'type'      => 'Sync'.ucfirst($sync_type),
            'status'    => 'waitting'
        ],$data);
    }
 

    // Handle Sync site tab
    /*
        general
        site-info
        woocommerce
        search
        scripts
        integration
        stripe
        paypal
    */
    
    public function sync(Request $request,$site_id = 0){
        session(['sync_position' => 0]);
        $synced_keys = $request->syncs ?? [];
        
        if(!$site_id){
            abort(404);
        }
        $site = Site::find($site_id);
        if( count($synced_keys) ){
            Log::info('['.$site->site_domain.'] Start sycn');
        }

        $syncs = [
            'init_settings' => 'Init Settings',
            'general' => 'General',
            'site-info' => 'Site info',
            'woocommerce'    => 'Woocommerce',
            'search'         => 'Search',
            'scripts'        => 'Scripts',
            'integration'    => 'Integration',
            'stripe'    => 'Stripe',
            'paypal'    => 'Paypal',
            'shipping_options'    => 'Shipping Options ',
        ];
        
        $params = [
            'site'      => $site,
            'site_id'   => $site_id,
            'syncs'     => $syncs,
            'synced_keys'  => $synced_keys,
        ];
        return view('admin.syncs.list',$params);
    }
    public function syncAjax(Request $request,$site_id){
        $site = Site::find($site_id);
        $this->site = $site;
        $this->web_hook = str_replace('__SITE_DOMAIN__',$site->site_domain,$this->web_hook);
        $syncs = $request->syncs;


        $sync_position = session('sync_position', 0);
        // $sync_position = 4;
        $loop = false;

        if( isset($syncs[$sync_position]) ){
            $sync_type = $syncs[$sync_position];
            $res = $this->syncByType($sync_type);
            // if loop, re-call ajax
            if( isset($res['loop']) ){ $loop = $res['loop']; }
            if( !$loop ){
                $sync_position++;
                session(['sync_position' => $sync_position]);
            }
            $res['sync_type'] = $sync_type;
        }else{
            session(['sync_position' => 0]);
            $res['next_step'] = 0;
            $site->last_sync = date('Y-m-d H:i:s');
            $site->save();
            Log::info('['.$site->site_domain.'] Sycn completed');
        }
        
        $res['site_id'] = $site_id;
        $res['sync_position'] = $sync_position;
        return response()->json($res);
    }

    private function syncByType($sync_type){
        switch ($sync_type) {
            case 'init_settings':
                $res =  $this->sync_init_settings();
                break;
            case 'shipping_options':
                $res =  $this->sync_shipping_options();
                break;
            default:
                $res =  $this->sync_site_tab($sync_type);
                break;
        }
        return $res;
    }

    private function sync_init_settings(){
        try {
            $response = Http::asForm()->post($this->web_hook.'init_settings', [
                'web_hook' => config('settings.web_hook_admin')
            ]);
            Log::info('['.$this->site->site_domain.'] - [init_settings]: Stop sync: '.json_encode($response->json()));
            return $response->json();
        } catch (\Exeption $e) {
            $return = [
                'next' => true,
                'msg'  => $e->getMessage()
            ];
            return response()->json($return);
        }
        
    }
    private function sync_type($type){
        $response = Http::get($this->web_hook.$type);
        return $response->json();
    }
    private function sync_shipping_options(){
        $response = Http::asForm()->post($this->web_hook.'shipping_options', [
            'shipper_methods_options' => json_decode($this->site->shipper_methods_options,true)
        ]);
        return $response->json();
    }
    private function sync_site_tab($type){
        $response = Http::get($this->web_hook.'site_tab&tab='.$type);
        return $response->json();
    }
}

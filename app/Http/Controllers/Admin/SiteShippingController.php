<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Codexshaper\WooCommerce\Facades\ShippingZone;
use Codexshaper\WooCommerce\Facades\ShippingMethod;
use App\Models\Site;


class SiteShippingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $site_id = $request->site_id;
        if(!$site_id){
            abort(404);
        }
        $site = $this->get_site_config($site_id);
        $shipping_zones = ShippingZone::all(['page'=>1]);
        $params = [
            'items'    => $shipping_zones,
            'site_id'   => $site_id,
            'site'      => $site,
        ];
        return view('admin.shipping_zones.index',$params);
    }

    public function show(Request $request,$zone_id)
    {
        $site_id = $request->site_id;
        $msg = $request->msg ?? '';
        if(!$site_id){
            abort(404);
        }
        $site = $this->get_site_config($site_id);
        $site->shipper_methods_options = json_decode($site->shipper_methods_options,true);

        $item = ShippingZone::find($zone_id)->toArray();
        $methods = ShippingZone::getShippingZoneMethods($zone_id)->toArray();
        // dd($methods);
        $params = [
            'item'          => $item,
            'methods'       => $methods,
            'site_id'       => $site_id,
            'zone_id'       => $zone_id,
            'site'       => $site,
            'msg'           => $msg,
        ];
        return view('admin.shipping_zones.show',$params);
    }

    public function edit(Request $request,$zone_id)
    {
        $site_id    = $request->site_id;
        $method_id  = $request->method_id;
        $msg = $request->msg ?? '';
        if(!$site_id){
            abort(404);
        }
        $site = $this->get_site_config($site_id);
        $site->shipper_methods_options = json_decode($site->shipper_methods_options,true);
        $date_delivery = $site->shipper_methods_options['shipper_methods'][$zone_id][$method_id]['date_delivery'] ?? 0;
        
        $item = ShippingZone::find($zone_id)->toArray();
        $method = ShippingZone::getShippingZoneMethod($zone_id, $method_id)->toArray();
        $params = [
            'item'          => $item,
            'method'        => $method,
            'date_delivery'        => $date_delivery,
            'site_id'       => $site_id,
            'zone_id'       => $zone_id,
            'site'          => $site,
            'msg'           => $msg,
        ];
        return view('admin.shipping_zones.shipping_method_detail',$params);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $site_id    = $request->site_id;
        $method_id  = $request->method_id;
        $zone_id    = $request->zone_id;
        $date_delivery    = $request->date_delivery;
        $msg = $request->msg ?? '';
        if(!$site_id){
            abort(404);
        }
        $site = $this->get_site_config($site_id);
        $options = $site->shipper_methods_options;
        $options = ($options) ? json_decode($options,true) : [];
        $options['shipper_methods'][$zone_id][$method_id]['date_delivery'] = $date_delivery;
        $site->shipper_methods_options = json_encode($options);
        $site->save();
        return redirect()->back()->with('msg','OK');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function get_site_config($site_id = 0){
        $site = Site::find($site_id);
        config(['woocommerce.store_url' => 'https://'.$site->site_domain]);
        config(['woocommerce.consumer_key' => $site->woocommerce_consumer_key]);
        config(['woocommerce.consumer_secret' => $site->woocommerce_consumer_secret]);
        return $site;
    }
}

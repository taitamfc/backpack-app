<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Codexshaper\WooCommerce\Facades\Order;
use App\Models\Site;


class SiteOrderController extends Controller
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
        $orders = Order::all(['page'=>1]);
        // dd($orders);
        $params = [
            'orders'    => $orders,
            'site_id'   => $site_id,
            'site'      => $site,
        ];
        return view('admin.orders.index',$params);
    }

    public function show(Request $request,$id)
    {
        $site_id = $request->site_id;
        $msg = $request->msg ?? '';
        if(!$site_id){
            abort(404);
        }
        $this->get_site_config($site_id);
        $order = Order::find($id)->toArray();
        $params = [
            'order'     => $order,
            'site_id'   => $site_id,
            'msg'   => $msg,
        ];
        return view('admin.orders.show',$params);
    }

    public function edit($id)
    {
        //
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
        $status = $request->status;
        $site_id = $request->site_id;
        if(!$site_id){
            abort(404);
        }
        $this->get_site_config($site_id);
        $data     = [
            'status' => $status,
        ];
        $order = Order::update($id, $data);
        return redirect()->route('orders.show',$id.'?site_id='.$site_id.'&msg=OK');
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

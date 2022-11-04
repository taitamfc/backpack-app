<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Codexshaper\WooCommerce\Facades\Order;
use App\Models\Site;
use App\Models\Order as OrderModel;


class OrderController extends Controller
{
    public function index()
    {
        //
    }
    public function store(Request $request)
    {
        //
    }
    public function show(Request $request, $action)
    {
        switch ($action) {
            case 'post':
                $domain = $request->domain;
                $order_id = $request->order_id;
                $site = Site::where('site_domain',$domain)->firstOrFail();
                config(['woocommerce.store_url' => 'https://'.$site->site_domain]);
                config(['woocommerce.consumer_key' => $site->woocommerce_consumer_key]);
                config(['woocommerce.consumer_secret' => $site->woocommerce_consumer_secret]);
                $order = Order::find($order_id)->toArray();
                $order['billing'] = json_encode($order['billing']);
                $order['shipping'] = json_encode($order['shipping']);
                $order['meta_data'] = json_encode($order['meta_data']);
                $order['line_items'] = json_encode($order['line_items']);
                $order['tax_lines'] = json_encode($order['tax_lines']);
                $order['shipping_lines'] = json_encode($order['shipping_lines']);
                $order['fee_lines'] = json_encode($order['fee_lines']);
                $order['coupon_lines'] = json_encode($order['coupon_lines']);
                $order['refunds'] = json_encode($order['refunds']);
                $order['order_id'] = $order['id'];
                unset($order['_links']);
                unset($order['id']);
                $orderObj = OrderModel::updateOrCreate([
                    'order_id' => $order_id,
                    'site_id' => $site->id,
                ],$order);
                return response()->json($orderObj);
                break;
            
            default:
                # code...
                break;
        }
        
    }
    public function edit($id)
    {
        //
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

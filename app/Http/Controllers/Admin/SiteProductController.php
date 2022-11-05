<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Codexshaper\WooCommerce\Facades\Product;
use App\Models\Site;

class SiteProductController extends Controller
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

        $options = [
            'per_page' => 5
        ];
        $items = Product::paginate(5);
        // dd($items);
        $params = [
            'items'    => $items,
            'site_id'   => $site_id,
            'site'      => $site,
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
        //
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

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\OrderRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use App\Models\Site;
use Codexshaper\WooCommerce\Facades\Order;
/**
 * Class OrderCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class OrderCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation { store as traitStore; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation { update as traitUpdate; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Order::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/order');
        CRUD::setEntityNameStrings('order', 'orders');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->addButton('top', 'back', 'view', 'end');

        $this->crud->removeButton('create');
        $this->crud->removeButton('show');
        $this->crud->removeButton('delete');

        CRUD::column('order_id');
        CRUD::addColumn([
            'name' => 'site_id', 
            'type' => 'model_function',
            'function_name' => 'getSiteName'
        ]); 
        CRUD::column('billing_email');
        CRUD::column('status');
        CRUD::column('total');
        CRUD::column('date_created');

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */

        $this->crud->custom_remove_top = true;
        $this->crud->custom_filter_type = 'order';
        $this->crud->custom_filter_request = $_REQUEST;
        $this->crud->custom_params = [
            'sites' => Site::all()->pluck('site_domain','id')->toArray()
        ];

        $status = $_REQUEST['status'] ?? '';
        $site_id = $_REQUEST['site_id'] ?? '';
        $date_start = $_REQUEST['date_start'] ?? '';
        $date_end = $_REQUEST['date_end'] ?? '';
        $billing_email = $_REQUEST['billing_email'] ?? '';
        if($status){
            $this->crud->addClause('where', 'status', '=', $status);
        }
        if($site_id){
            $this->crud->addClause('where', 'site_id', '=', $site_id);
        }
        if($date_start){
            $this->crud->addClause('where', 'date_created', '>=', $date_start);
        }
        if($date_end){
            $this->crud->addClause('where', 'date_created', '<=', $date_start);
        }
        if($billing_email){
            $this->crud->addClause('where', 'billing_email', '=', $billing_email);
        }


        // Check user is have permisson on single site
        if( backpack_user()->hasPermissionTo('Single Site-orders') && backpack_user()->site_id ){
            $this->crud->addClause('where', 'id', '=', backpack_user()->site_id);
        }
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {   
        $currentEntry = $this->crud->getCurrentEntry();
        CRUD::setValidation([
            // 'name' => 'required|min:2',
        ]);
        $statuses = ['pending','processing','on-hold','completed','cancelled','refunded','failed','checkout-draft'];
        $statuses = array_combine($statuses,$statuses);
        $this->crud->addField(['name'=>'site_id','type' => 'hidden','tab' => 'Detail']);
        $this->crud->addField(['name'=>'order_id','tab' => 'Detail','attributes'=>['disabled' => 'disabled']]);
        $this->crud->addField(['name'=>'date_created','tab' => 'Detail']);
        $this->crud->addField(['name'=>'status','type' => 'select_from_array','options'=> $statuses ,'tab' => 'Detail']);
        $this->crud->addField(['name'=>'payment_method_title','tab' => 'Detail','attributes'=>['disabled' => 'disabled']]);
        $this->crud->addField(['name'=>'transaction_id','tab' => 'Detail','attributes'=>['disabled' => 'disabled']]);
        $this->crud->addField(['name'=>'customer_note','tab' => 'Detail','attributes'=>['disabled' => 'disabled']]);
        
        $this->crud->addField(['name'=>'billing_first_name','tab' => 'Billing Info']);
        $this->crud->addField(['name'=>'billing_last_name','tab' => 'Billing Info']);
        $this->crud->addField(['name'=>'billing_email','tab' => 'Billing Info','attributes'=>['disabled' => 'disabled']]);
        $this->crud->addField(['name'=>'billing_company','tab' => 'Billing Info']);
        $this->crud->addField(['name'=>'billing_address_1','tab' => 'Billing Info']);
        $this->crud->addField(['name'=>'billing_address_2','tab' => 'Billing Info']);
        $this->crud->addField(['name'=>'billing_city','tab' => 'Billing Info']);
        $this->crud->addField(['name'=>'billing_state','tab' => 'Billing Info']);
        $this->crud->addField(['name'=>'billing_postcode','tab' => 'Billing Info']);
        $this->crud->addField(['name'=>'billing_country','tab' => 'Billing Info']);
        $this->crud->addField(['name'=>'billing_phone','tab' => 'Billing Info']);


        $this->crud->addField(['name'=>'shipping_first_name','tab' => 'Shipping Info']);
        $this->crud->addField(['name'=>'shipping_last_name','tab' => 'Shipping Info']);
        $this->crud->addField(['name'=>'shipping_email','tab' => 'Shipping Info']);
        $this->crud->addField(['name'=>'shipping_company','tab' => 'Shipping Info']);
        $this->crud->addField(['name'=>'shipping_address_1','tab' => 'Shipping Info']);
        $this->crud->addField(['name'=>'shipping_address_2','tab' => 'Shipping Info']);
        $this->crud->addField(['name'=>'shipping_city','tab' => 'Shipping Info']);
        $this->crud->addField(['name'=>'shipping_state','tab' => 'Shipping Info']);
        $this->crud->addField(['name'=>'shipping_postcode','tab' => 'Shipping Info']);
        $this->crud->addField(['name'=>'shipping_country','tab' => 'Shipping Info']);
        $this->crud->addField(['name'=>'shipping_phone','tab' => 'Shipping Info']);

        
        $line_items = $currentEntry->line_items;
        $line_items = json_decode($line_items);
        $product_html = '<table class="table table-bordered">';
        $product_html .= '<tr>';
            $product_html .= '<th>image</th>';
            $product_html .= '<th>name</th>';
            $product_html .= '<th>meta_data</th>';
            $product_html .= '<th>subtotal</th>';
            $product_html .= '<th>quantity</th>';
            $product_html .= '<th>total</th>';
        $product_html .= '</tr>';
        foreach( $line_items as $line_item ){
            $product_html .= '<tr>';
                $product_html .= '<td><img width="50" src="'.$line_item->image->src.'"></td>';
                $product_html .= '<td>'.$line_item->name.'</td>';
                $product_html .= '<td>'.$line_item->meta_data[0]->display_key.': '.$line_item->meta_data[0]->display_value.'<br>';
                $product_html .= $line_item->meta_data[1]->display_key.': '.$line_item->meta_data[1]->display_value.'</td>';
                $product_html .= '<td>'.$line_item->subtotal.'</td>';
                $product_html .= '<td>'.$line_item->quantity.'</td>';
                $product_html .= '<td>'.$line_item->total.'</td>';
            $product_html .= '</tr>';
        }
        $product_html .= '</table>';

        $this->crud->addField(['name'=>'line_items','tab' => 'Line Items',
            'type' => 'custom_html',
            'value' => $product_html
        ]);

        $currentEntry->shipping_lines = json_decode($currentEntry->shipping_lines);

        $shipping_html = '<table class="table table-bordered">';
            foreach( $currentEntry->shipping_lines as $shipping_line ){
                $shipping_html .= '<tr>';
                    $shipping_html .= '<td>'.$shipping_line->method_title.'</td>';
                    $shipping_html .= '<td>'.$shipping_line->total.'</td>';
                $shipping_html .= '</tr>';
            }
            $shipping_html .= '<tr>';
                $shipping_html .= '<td>Order total</td>';
                $shipping_html .= '<td>'.$currentEntry->total.'</td>';
            $shipping_html .= '</tr>';
        $shipping_html .= '</table>';
        $this->crud->addField(['name'=>'shipping_lines','tab' => 'Line Items',
            'type' => 'custom_html',
            'value' => $shipping_html
        ]);

        $currentEntry->meta_data = json_decode($currentEntry->meta_data);
        $meta_datas = [];
        foreach( $currentEntry->meta_data as $key => $meta_data ){
            $meta_datas[$meta_data->key] = $meta_data->value;
        }

        $meta_data_html = '<table class="table table-bordered">';
        foreach($currentEntry->meta_data as $meta_data ){
            $meta_data_html .= '<tr>';
                $meta_data_html .= '<td>'.ucfirst(trim(str_replace('_',' ',$meta_data->key))).'</td>';
                $meta_data_html .= '<td>'.$meta_data->value.'</td>';
            $meta_data_html .= '</tr>';
        }
        $meta_data_html .= '</table>';
        $this->crud->addField(['name'=>'meta_data','tab' => 'Line Items',
            'type' => 'custom_html',
            'value' => $meta_data_html
        ]);

   

        $this->crud->addField(['name'=>'ywot_picked_up','type'=>'checkbox','label'=>'Tracking code','tab' => 'Tracking']);
        $this->crud->addField(['name'=>'ywot_tracking_code','label'=>'Tracking code','tab' => 'Tracking']);
        $this->crud->addField(['name'=>'ywot_pick_up_date','label'=>'Pickup date','type' => 'date','tab' => 'Tracking']);
        $this->crud->addField(['name'=>'ywot_carrier_name','label'=>'Carrier name','tab' => 'Tracking']);
        $this->crud->addField(['name'=>'ywot_carrier_url','label'=>'Carrier website link','tab' => 'Tracking']);


        // dd($currentEntry->meta_data);
       

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->crud->setEditContentClass('col-md-12 bold-labels');
        $request = $this->crud->getRequest();
        $this->setupCreateOperation();

    }

    public function store()
    {
      // do something before validation, before save, before everything
      $response = $this->traitStore();
      // do something after save
    //   dd(__METHOD__);
      return $response;
    }
    public function update()
    {
        // do something before validation, before save, before everything
        $response = $this->traitUpdate();
        // do something after save - sync order to wp site
        $currentEntry = $this->crud->getCurrentEntry();
        $request = $this->crud->getRequest()->toArray();
        $meta_datas = json_decode($currentEntry->meta_data,true);
        foreach( $meta_datas as $key => $meta_data ){
            if($meta_datas[$key]['key'] == 'ywot_tracking_code'){
                $meta_datas[$key]['value'] = $request['ywot_tracking_code'];
            }
            if($meta_datas[$key]['key'] == 'ywot_pick_up_date'){
                $meta_datas[$key]['value'] = $request['ywot_pick_up_date'];
            }
            if($meta_datas[$key]['key'] == 'ywot_picked_up'){
                $meta_datas[$key]['value'] = $request['ywot_picked_up'];
            }
            if($meta_datas[$key]['key'] == 'ywot_carrier_name'){
                $meta_datas[$key]['value'] = $request['ywot_carrier_name'];
            }
            if($meta_datas[$key]['key'] == 'ywot_carrier_url'){
                $meta_datas[$key]['value'] = $request['ywot_carrier_url'];
            }
        }

        $order_id = $currentEntry->order_id;
        $site_id = $request['site_id'];
        $site = $this->get_site_config($site_id);
        $data     = [
            'status' => $request['status'],
            'meta_data' => $meta_datas,
        ];
        $order = Order::update($order_id, $data);  

        return $response;
    }
    private function get_site_config($site_id = 0){
        $site = Site::find($site_id);
        config(['woocommerce.store_url' => 'https://'.$site->site_domain]);
        config(['woocommerce.consumer_key' => $site->woocommerce_consumer_key]);
        config(['woocommerce.consumer_secret' => $site->woocommerce_consumer_secret]);
        return $site;
    }
}

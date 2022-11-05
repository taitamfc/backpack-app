<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\OrderRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use App\Models\Site;

/**
 * Class OrderCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class OrderCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
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
        $this->crud->removeButton('create');
        $this->crud->removeButton('show');
        $this->crud->removeButton('delete');

        CRUD::column('order_id');
        CRUD::addColumn([
            'name' => 'site_id', 
            'type' => 'model_function',
            'function_name' => 'getSiteName'
        ]); 
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
        if($status){
            $this->crud->addClause('where', 'status', '=', $status);
        }
        if($date_start){
            $this->crud->addClause('where', 'date_created', '>=', $date_start);
        }
        if($date_end){
            $this->crud->addClause('where', 'date_created', '<=', $date_start);
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
        $this->crud->addField(['name'=>'order_id','tab' => 'Detail']);
        $this->crud->addField(['name'=>'date_created','tab' => 'Detail']);
        $this->crud->addField(['name'=>'status','tab' => 'Detail']);
        
        $billing = $currentEntry->billing;
        $billing = json_decode($billing);
        $this->crud->addField(['name'=>'billing_first_name','tab' => 'Billing',
            'store_in' => 'billing',
            'fake'=>true,
            'value'=>$billing->billing_first_name
        ]);
        $this->crud->addField(['name'=>'billing_last_name','tab' => 'Billing',
            'store_in' => 'billing',
            'fake'=>true,
            'value'=>$billing->billing_last_name
        ]);
        $this->crud->addField(['name'=>'billing_company','tab' => 'Billing',
            'store_in' => 'billing',
            'fake'=>true,
            'value'=>$billing->billing_company
        ]);
        $this->crud->addField(['name'=>'billing_address_1','tab' => 'Billing',
            'store_in' => 'billing',
            'fake'=>true,
            'value'=>$billing->billing_address_1
        ]);
        $this->crud->addField(['name'=>'billing_address_2','tab' => 'Billing',
            'store_in' => 'billing',
            'fake'=>true,
            'value'=>$billing->billing_address_2
        ]);
        $this->crud->addField(['name'=>'billing_city','tab' => 'Billing',
            'store_in' => 'billing',
            'fake'=>true,
            'value'=>$billing->billing_city
        ]);
        $this->crud->addField(['name'=>'billing_state','tab' => 'Billing',
            'store_in' => 'billing',
            'fake'=>true,
            'value'=>$billing->billing_state
        ]);
        $this->crud->addField(['name'=>'billing_postcode','tab' => 'Billing',
            'store_in' => 'billing',
            'fake'=>true,
            'value'=>$billing->billing_postcode
        ]);
        $this->crud->addField(['name'=>'billing_country','tab' => 'Billing',
            'store_in' => 'billing',
            'fake'=>true,
            'value'=>$billing->billing_country
        ]);
        $this->crud->addField(['name'=>'billing_phone','tab' => 'Billing',
            'store_in' => 'billing',
            'fake'=>true,
            'value'=>$billing->billing_phone
        ]);

        $shipping = $currentEntry->shipping;
        $shipping = json_decode($shipping);
        $this->crud->addField(['name'=>'shipping_first_name','tab' => 'Shipping',
            'store_in' => 'shipping',
            'fake'=>true,
            'value'=>$shipping->shipping_first_name
        ]);
        $this->crud->addField(['name'=>'shipping_last_name','tab' => 'Shipping',
            'store_in' => 'shipping',
            'fake'=>true,
            'value'=>$shipping->shipping_last_name
        ]);
        $this->crud->addField(['name'=>'shipping_company','tab' => 'Shipping',
            'store_in' => 'shipping',
            'fake'=>true,
            'value'=>$shipping->shipping_company
        ]);
        $this->crud->addField(['name'=>'shipping_address_1','tab' => 'Shipping',
            'store_in' => 'shipping',
            'fake'=>true,
            'value'=>$shipping->shipping_address_1
        ]);
        $this->crud->addField(['name'=>'shipping_address_2','tab' => 'Shipping',
            'store_in' => 'shipping',
            'fake'=>true,
            'value'=>$shipping->shipping_address_2
        ]);
        $this->crud->addField(['name'=>'shipping_city','tab' => 'Shipping',
            'store_in' => 'shipping',
            'fake'=>true,
            'value'=>$shipping->shipping_city
        ]);
        $this->crud->addField(['name'=>'shipping_state','tab' => 'Shipping',
            'store_in' => 'shipping',
            'fake'=>true,
            'value'=>$shipping->shipping_state
        ]);
        $this->crud->addField(['name'=>'shipping_postcode','tab' => 'Shipping',
            'store_in' => 'shipping',
            'fake'=>true,
            'value'=>$shipping->shipping_postcode
        ]);
        $this->crud->addField(['name'=>'shipping_country','tab' => 'Shipping',
            'store_in' => 'shipping',
            'fake'=>true,
            'value'=>$shipping->shipping_country
        ]);
        $this->crud->addField(['name'=>'shipping_phone','tab' => 'Shipping',
            'store_in' => 'shipping',
            'fake'=>true,
            'value'=>$shipping->shipping_phone
        ]);

        $line_items = $currentEntry->line_items;
        $line_items = json_decode($line_items);
        $product_html = '<table class="table">';
        $product_html .= '<tr>';
            $product_html .= '<td>name</td>';
            $product_html .= '<td>meta_data</td>';
            $product_html .= '<td>subtotal</td>';
            $product_html .= '<td>quantity</td>';
            $product_html .= '<td>total</td>';
        $product_html .= '</tr>';
        foreach( $line_items as $line_item ){
            $product_html .= '<tr>';
                $product_html .= '<td>'.$line_item->name.'</td>';
                $product_html .= '<td>'.$line_item->meta_data[0]->display_key.': '.$line_item->meta_data[0]->display_value.'<br>';
                $product_html .= $line_item->meta_data[1]->display_key.': '.$line_item->meta_data[1]->display_value.'</td>';
                $product_html .= '<td>'.$line_item->subtotal.'</td>';
                $product_html .= '<td>'.$line_item->quantity.'</td>';
                $product_html .= '<td>'.$line_item->total.'</td>';
            $product_html .= '</tr>';
        }
        $product_html .= '<table>';

        $this->crud->addField(['name'=>'line_items','tab' => 'Line Items',
            'type' => 'custom_html',
            'value' => $product_html
        ]);
       

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
}

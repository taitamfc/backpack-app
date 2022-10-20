<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SiteRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use App\Models\Site;
use Illuminate\Http\Request;

/**
 * Class SiteCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class SiteCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Site::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/site');
        CRUD::setEntityNameStrings('site', 'sites');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        
        $this->crud->setColumns(['site_title', 'site_domain','last_sync']);
        $this->crud->addButtonFromModelFunction('line', 'sync_action', 'sync_action_button', 'end');
        $this->crud->addButtonFromModelFunction('line', 'orders_action', 'orders_action_button', 'end');
    }

    

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation([
            'site_title' => 'required|min:2',
            'site_domain' => 'required|min:2',
        ]);

        CRUD::field('site_title');
        CRUD::field('tagline');
        CRUD::field('topbar_content');
        CRUD::field('site_domain');
        CRUD::field('api_key');
        // CRUD::field('product_api_url');
        CRUD::field('product_start_id');
        CRUD::field('product_end_id');
        CRUD::field('product_limit_per_call');
        CRUD::field('product_call_interval');
        // CRUD::field('product_detail_api_url');
        CRUD::field('product_detail_limit_per_call');
        CRUD::field('import_to_wp_limit_per_call');
        CRUD::field('product_detail_call_interval');
        CRUD::field('import_to_wp_interval');
        CRUD::field('import_to_wp_interval');
        CRUD::field('site_address');
        CRUD::field('administration_email_address');
        CRUD::field('site_phone');
        CRUD::field('contact_email_address');
        CRUD::field('site_open_hours');
        CRUD::field('web_hook');
        CRUD::field('woocommerce_consumer_key');
        CRUD::field('woocommerce_consumer_secret');
        // CRUD::field('product_tags');
        // CRUD::field('product_events');
        CRUD::field('site_map');

        

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
        $this->setupCreateOperation();
    }

    
}

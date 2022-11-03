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
        
        $this->crud->setColumns(['site_domain','last_sync']);
        $this->crud->removeButton('show');
        if( !backpack_user()->hasPermissionTo('Sites-create') ){
            $this->crud->removeButton('create');
        }
        if( !backpack_user()->hasPermissionTo('Sites-update') ){
            $this->crud->removeButton('update');
        }
        if( !backpack_user()->hasPermissionTo('Sites-delete') ){
            $this->crud->removeButton('delete');
        }

        // Check user is have permisson on single site
        if( !backpack_user()->hasPermissionTo('Sites-index') ){
            if( backpack_user()->hasPermissionTo('Single Site-index') ){
                $this->crud->addClause('where', 'site_domain', '=', 'nacamio.com');
            }
        }


        if( backpack_user()->hasPermissionTo('Single Site-sync') ){
            $this->crud->addButtonFromModelFunction('line', 'sync_action', 'sync_action_button', 'end');
        }
        if( backpack_user()->hasPermissionTo('Single Site-orders') ){
            $this->crud->addButtonFromModelFunction('line', 'orders_action', 'orders_action_button', 'end');
        }
        if( backpack_user()->hasPermissionTo('Single Site-shippings') ){
            $this->crud->addButtonFromModelFunction('line', 'shipping_action', 'shippings_action_action_button', 'end');
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
        CRUD::field('search_config_active');
        CRUD::field('search_config_keywords');
        CRUD::field('html_scripts_header');
        CRUD::field('html_scripts_footer');
        CRUD::field('html_scripts_after_body');
        CRUD::field('html_scripts_before_body');
        CRUD::field('google_api_key');
        CRUD::field('facebook_api_key');

        

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

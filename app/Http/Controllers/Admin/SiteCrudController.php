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
        if( !backpack_user()->hasPermissionTo('Sites-update') && !backpack_user()->hasPermissionTo('Single Site-update') ){
            $this->crud->removeButton('update');
        }
        if( !backpack_user()->hasPermissionTo('Sites-delete') ){
            $this->crud->removeButton('delete');
        }

        // Check user is have permisson on single site
        // if( !backpack_user()->hasPermissionTo('Sites-index') ){
            if( backpack_user()->hasPermissionTo('Single Site-index') && backpack_user()->site_id ){
                $this->crud->addClause('where', 'id', '=', backpack_user()->site_id);
            }
        // }


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
        $this->crud->setCreateContentClass('col-md-12 bold-labels');

        CRUD::setValidation([
            'site_title' => 'required|min:2',
            'site_domain' => 'required|min:2',
        ]);

        $this->crud->addField(['name'=>'site_title','tab' => 'General']);
        $this->crud->addField(['name'=>'tagline','tab' => 'General']);
        $this->crud->addField(['name'=>'administration_email_address','tab' => 'General']);
        $this->crud->addField(['name'=>'topbar_content','tab' => 'General']);
        $this->crud->addField(['name'=>'site_domain','tab' => 'General']);
        // $this->crud->addField(['name'=>'web_hook','tab' => 'General']);
        $this->crud->addField(['name'=>'show_admin_bar','type'=>'checkbox','tab' => 'General']);


        $this->crud->addField(['name'=>'api_key','tab' => 'Api Setting']);
        $this->crud->addField(['name'=>'product_start_id','tab' => 'Api Setting']);
        $this->crud->addField(['name'=>'product_end_id','tab' => 'Api Setting']);
        $this->crud->addField(['name'=>'product_limit_per_call','tab' => 'Api Setting']);
        $this->crud->addField(['name'=>'product_call_interval','tab' => 'Api Setting']);
        $this->crud->addField(['name'=>'product_detail_limit_per_call','tab' => 'Api Setting']);
        $this->crud->addField(['name'=>'product_detail_call_interval','tab' => 'Api Setting']);
        $this->crud->addField(['name'=>'import_to_wp_limit_per_call','tab' => 'Api Setting']);
        $this->crud->addField(['name'=>'import_to_wp_interval','tab' => 'Api Setting']);

        $this->crud->addField(['name'=>'site_address','tab' => 'Site Info']);
        $this->crud->addField(['name'=>'site_phone','tab' => 'Site Info']);
        $this->crud->addField(['name'=>'contact_email_address','tab' => 'Site Info']);
        $this->crud->addField(['name'=>'site_open_hours','tab' => 'Site Info']);
        $this->crud->addField(['name'=>'site_map','tab' => 'Site Info']);

        if( backpack_user()->hasPermissionTo('Sites field - Woocommerce consumer key') ){
            $this->crud->addField(['name'=>'woocommerce_consumer_key','tab' => 'Woocommerce']);
        }
        if( backpack_user()->hasPermissionTo('Sites field - Woocommerce consumer secret') ){
            $this->crud->addField(['name'=>'woocommerce_consumer_secret','tab' => 'Woocommerce']);
        }

        $this->crud->addField(['name'=>'search_config_active','type'=>'checkbox','tab' => 'Search']);
        $this->crud->addField(['name'=>'search_config_keywords','tab' => 'Search']);

        $this->crud->addField(['name'=>'html_scripts_header','tab' => 'Scripts']);
        $this->crud->addField(['name'=>'html_scripts_footer','tab' => 'Scripts']);
        $this->crud->addField(['name'=>'html_scripts_after_body','tab' => 'Scripts']);
        $this->crud->addField(['name'=>'html_scripts_before_body','tab' => 'Scripts']);

        if( backpack_user()->hasPermissionTo('Sites field - Google api key') ){
            $this->crud->addField(['name'=>'google_api_key','tab' => 'Integration']);
        }
        if( backpack_user()->hasPermissionTo('Sites field - Facebook api key') ){
            $this->crud->addField(['name'=>'facebook_api_key','tab' => 'Integration']);
        }
        $this->crud->addField(['name'=>'stripe_sandbox_on','type'=>'checkbox','tab' => 'Stripe']);
        $this->crud->addField(['name'=>'stripe_live_publishable_key','tab' => 'Stripe']);
        $this->crud->addField(['name'=>'stripe_live_secret_key','tab' => 'Stripe']);
        $this->crud->addField(['name'=>'stripe_test_publishable_key','tab' => 'Stripe']);
        $this->crud->addField(['name'=>'stripe_test_secret_key','tab' => 'Stripe']);

        $this->crud->addField(['name'=>'paypal_sandbox_on','type'=>'checkbox','tab' => 'Paypal']);
        $this->crud->addField(['name'=>'paypal_sandbox_email_address','tab' => 'Paypal']);
        $this->crud->addField(['name'=>'paypal_sandbox_merchant_id','tab' => 'Paypal']);
        $this->crud->addField(['name'=>'paypal_sandbox_client_id','tab' => 'Paypal']);
        $this->crud->addField(['name'=>'paypal_sandbox_secret_key','tab' => 'Paypal']);
        $this->crud->addField(['name'=>'paypal_live_email_address','tab' => 'Paypal']);
        $this->crud->addField(['name'=>'paypal_live_merchant_id','tab' => 'Paypal']);
        $this->crud->addField(['name'=>'paypal_live_client_id','tab' => 'Paypal']);
        $this->crud->addField(['name'=>'paypal_live_secret_key','tab' => 'Paypal']);
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

        $this->setupCreateOperation();
    }

    
}

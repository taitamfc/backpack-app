<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SiteJobRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use App\Models\Site;

/**
 * Class SiteJobCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class SiteJobCrudController extends CrudController
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
        CRUD::setModel(\App\Models\SiteJob::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/site-job');
        CRUD::setEntityNameStrings('site-job', 'site jobs');
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
        // $this->crud->addButton('top', 'sync', 'view', 'end');

        $this->crud->removeButton('show');

        CRUD::addColumn([
            'name' => 'site_id', 
            'type' => 'model_function',
            'function_name' => 'getSiteName'
        ]); 
        CRUD::column('name');
        CRUD::column('status');
        CRUD::addColumn([
            'name' => 'progress', 
            'type' => 'model_function',
            'function_name' => 'getProgress'
        ]); 
        
        
        $site_id = $_REQUEST['site_id'] ?? '';
        if($site_id){
            $this->crud->addClause('where', 'site_id', '=', $site_id);
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
            'name' => 'required|min:2',
            // 'product_call_interval' => 'required',
            // 'product_detail_call_interval' => 'required',
            // 'import_to_wp_interval' => 'required',
            'status' => 'required',
            'site_id' => 'required',
            'type' => 'required',
        ]);
        
        $sites = Site::all()->pluck('site_domain','id')->toArray();
        $intervals = [
            'everyminutes' => 'Every minutes'
        ];
        $statuses = [
            'draft' => 'Draft',
            'waitting' => 'Waitting',
            'working' => 'Working',
            'pause' => 'Pause',
            'completed' => 'Completed',
        ];
        $types = [
            'SyncMenu' => 'SyncMenu',
            'SyncEvent' => 'SyncEvent',
            'SyncCategories' => 'SyncCategory',
            // 'SyncTags' => 'SyncTags',
            'ImportProduct' => 'ImportProduct',
        ];
        $this->crud->addField(['name'=>'name','tab' => 'General']);
        $this->crud->addField(['name'=>'type','type'=>'select_from_array','options' => $types,'tab' => 'General']);

        $this->crud->addField(['name'=>'site_id','type'=>'select_from_array','options' => $sites,'tab' => 'General']);
        $this->crud->addField(['name'=>'status','type'=>'select_from_array','options' => $statuses,'tab' => 'General']);
        $this->crud->addField(['name'=>'product_start_id','tab' => 'Import Setting']);
        $this->crud->addField(['name'=>'product_end_id','tab' => 'Import Setting']);
        $this->crud->addField(['name'=>'product_limit_per_call','tab' => 'Import Setting']);
        $this->crud->addField(['name'=>'product_call_interval','type'=>'select_from_array','options' => $intervals,'tab' => 'Import Setting']);
        $this->crud->addField(['name'=>'product_detail_limit_per_call','tab' => 'Import Setting']);
        $this->crud->addField(['name'=>'product_detail_call_interval','type'=>'select_from_array','options' => $intervals,'tab' => 'Import Setting']);
        $this->crud->addField(['name'=>'import_to_wp_limit_per_call','tab' => 'Import Setting']);
        $this->crud->addField(['name'=>'import_to_wp_interval','type'=>'select_from_array','options' => $intervals,'tab' => 'Import Setting']);

        
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

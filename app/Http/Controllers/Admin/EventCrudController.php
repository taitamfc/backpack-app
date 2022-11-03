<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\EventRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Str;

/**
 * Class EventCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class EventCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation { store as traitStore; }

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Event::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/event');
        CRUD::setEntityNameStrings('event', 'events');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->addButton('top', 'sync', 'view', 'end');


        CRUD::column('name');
        CRUD::column('slug');
        CRUD::column('created_at');
        CRUD::column('updated_at');
        

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
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
            'product_tags' => 'required',
        ]);
        CRUD::field('name');
        CRUD::field('slug')->on('saving', function ($entry) {
            $entry->slug = Str::slug($entry->name);
        });
        $days = $months = [];
        for ($i=1; $i <=31 ; $i++) { 
            $days[$i] = $i;
            if( $i <= 12  ){
                $months[$i] = $i;
            }
        }
        $this->crud->addField([   // select_from_array
            'name'        => 'start_day',
            'label'       => "Start Day",
            'type'        => 'select_from_array',
            'options'     => $days,
            'allows_null' => false,
            'default'     => '1',
        ]);
        $this->crud->addField([   // select_from_array
            'name'        => 'start_month',
            'label'       => "Start Month",
            'type'        => 'select_from_array',
            'options'     => $months,
            'allows_null' => false,
            'default'     => '1',
        ]);
        $this->crud->addField([   // select_from_array
            'name'        => 'end_day',
            'label'       => "End Day",
            'type'        => 'select_from_array',
            'options'     => $months,
            'allows_null' => false,
            'default'     => '1',
        ]);
        // CRUD::field('image_url');
        $this->crud->addField([   // Upload
            'name'      => 'image_url',
            'label'     => 'Image',
            'type'      => 'upload',
            'upload'    => true,
            'disk'      => 'local',
         ]);
        CRUD::field('product_tags');

        

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

    // public function store()
    // {
    //   // do something before validation, before save, before everything
    //   $response = $this->traitStore();
    //   dd($response);
    //   // do something after save
    //   return $response;
    // }
}
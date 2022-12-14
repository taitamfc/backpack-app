<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'sites';
    // protected $primaryKey = 'id';
    public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public function sync_action_button($crud = false)
    {
        return '<a href="'.route('syncs.sync',$this->id).'" class="btn btn-sm btn-link"><i class="la la-sync"></i>Sync</a>';
    }
    public function orders_action_button($crud = false)
    {
        return '<a href="'. backpack_url('order').'?site_id='. $this->id.'" class="btn btn-sm btn-link"><i class="la la-files-o"></i>Orders</a>';
    }
    public function shippings_action_action_button($crud = false)
    {
        return '<a href="'. route('shippings.index').'?site_id='. $this->id.'" class="btn btn-sm btn-link"><i class="la la-files-o"></i>Shippings</a>';
    }
    public function products_action_action_button($crud = false)
    {
        return '<a href="'. route('products.index').'?site_id='. $this->id.'" class="btn btn-sm btn-link"><i class="la la-files-o"></i>Products</a>';
    }
    public function jobs_action_action_button($crud = false)
    {
        return '<a href="'. backpack_url('site-job').'?site_id='. $this->id.'" class="btn btn-sm btn-link"><i class="la la-files-o"></i>Jobs</a>';
    }
    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}

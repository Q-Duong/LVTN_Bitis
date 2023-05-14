<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = true; //set time to false
    protected $fillable = [
    	'product_name','product_price','product_tag', 'product_description','product_type_id'
    ];
    protected $primaryKey = 'product_id';
 	protected $table = 'product';

    //  public function category_product(){
    //     return $this->belongsTo('App\Models\CategoryProduct','category_product_id');
    // }

    // public function producer(){
    //     return $this->belongsTo('App\Models\Producer','producer_id');
    // }

    // public function comment(){
    //     return $this->hasMany('App\Models\Comment');
    // }
}

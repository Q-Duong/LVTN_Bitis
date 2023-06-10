<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = true; //set time to false
    protected $fillable = [
    	'product_name','product_price','product_tag', 'product_description','product_type_id','category_id','product_slug','product_image'
    ];
    protected $primaryKey = 'product_id';
 	protected $table = 'product';

     public function productType(){
        return $this->belongsTo('App\Models\ProductType','product_type_id');
    }
    public function category(){
        return $this->belongsTo('App\Models\Category','category_id');
    }
    public function wareHouse(){
        $this->hasMany("App\Model\WareHouse");
    }

    // public function comment(){
    //     return $this->hasMany('App\Models\Comment');
    // }
}

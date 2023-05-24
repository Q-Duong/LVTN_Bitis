<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryType extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'category_id', 'product_type_id'
    ];
    protected $primaryKey = 'category_type_id';
 	protected $table = 'category_type';
   
    public function category(){
       return $this->belongsTo('App\Models\Category','category_id');
    }
    public function productType(){
        return $this->belongsTo('App\Models\ProductType','product_type_id');
    }

}

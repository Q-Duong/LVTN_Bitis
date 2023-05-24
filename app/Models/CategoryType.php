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
<<<<<<< HEAD
    public function Category(){
        $this->belongsTo('App\Model\Category','category_id');
    }
    public function Product_Type(){
        $this->belongsTo('App\Model\Product_Type','product_type_id');
    }
=======
   
    public function category(){
       return $this->belongsTo('App\Models\Category','category_id');
    }
    public function productType(){
        return $this->belongsTo('App\Models\ProductType','product_type_id');
    }

>>>>>>> e4a3fd3311c7963d259b784ef7c455cc28748d3f
}

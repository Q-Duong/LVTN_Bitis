<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'category_name','Category_slug'
    ];
    protected $primaryKey = 'category_id';
 	protected $table = 'category';
<<<<<<< HEAD
    
     public function categorytype(){
         $this->hasMany("App\Model\CategoryType");
     }

     public function product(){
        $this->hasMany("App\Model\Product");
=======

    public function categoryType(){
        $this->hasMany('App\Models\CategoryType');
>>>>>>> e4a3fd3311c7963d259b784ef7c455cc28748d3f
    }
}

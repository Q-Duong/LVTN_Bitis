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
    
     public function categorytype(){
         $this->hasMany("App\Model\CategoryType");
     }

     public function product(){
        $this->hasMany("App\Model\Product");
    }
}

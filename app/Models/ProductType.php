<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
        'product_type_name',
        'product_type_slug'
    ];
    protected $primaryKey = 'product_type_id';
<<<<<<< HEAD
    protected $table = 'product_type';

    public function CategoryType()
    {
        $this->hasMany("App\Model\CategoryType");
    }
    public function product()
    {
        $this->hasMany("App\Model\Product");
    }
}
=======
 	protected $table = 'product_type';

    public function categoryType(){
        $this->hasMany('App\Models\CategoryType');
    }
}
>>>>>>> e4a3fd3311c7963d259b784ef7c455cc28748d3f

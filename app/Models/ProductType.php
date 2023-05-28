<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
        'product_type_name',
        'product_type_slug',
        'product_type_img'
    ];
    protected $primaryKey = 'product_type_id';
    protected $table = 'product_type';

    public function categoryType()
    {
        $this->hasMany("App\Model\CategoryType");
    }
    public function product()
    {
        $this->hasMany("App\Model\Product");
    }
}

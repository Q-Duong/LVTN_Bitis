<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductDetailColor extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'product_detail_id ', 'color_id '
    ];
    protected $primaryKey = 'product_detail_color_id';
 	protected $table = 'product_detail_color';
}

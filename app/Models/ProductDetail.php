<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'size_id ', 'color_id ','product_id','product_quantity'
    ];
    protected $primaryKey = 'product_detail_id';
 	protected $table = 'product_detail';
}

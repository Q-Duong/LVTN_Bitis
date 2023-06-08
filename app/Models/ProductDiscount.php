<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductDiscount extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'product_id','discount_id'
    ];
    protected $primaryKey = 'product_discount_id';
 	protected $table = 'product_discount';

}

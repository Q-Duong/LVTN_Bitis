<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'product_id','ware_hourse_id'
    ];
    protected $primaryKey = 'product_detail_id';
 	protected $table = 'product_detail';
}

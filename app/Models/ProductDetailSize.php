<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductDetailSize extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'product_detail_id ', 'size_id'
    ];
    protected $primaryKey = 'product_detail_size_id ';
 	protected $table = 'product_detail_size';
}

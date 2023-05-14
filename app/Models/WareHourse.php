<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WareHourse extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'ware_hourse_quantity', 'ware_hourse_status','product_detail_id'
    ];
    protected $primaryKey = 'ware_hourse_id ';
 	protected $table = 'ware_hourse';
}

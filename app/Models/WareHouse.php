<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WareHouse extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'ware_house_quantity', 'ware_house_status','size_id', 'color_id'
    ];
    protected $primaryKey = 'ware_house_id ';
 	protected $table = 'ware_house';
}

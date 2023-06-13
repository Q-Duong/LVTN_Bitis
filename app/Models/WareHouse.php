<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WareHouse extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'ware_house_quantity', 'ware_house_status','size_id', 'color_id', 'product_id'
    ];
    protected $primaryKey = 'ware_house_id ';
 	protected $table = 'ware_house';

     public function size(){
        return $this->belongsTo('App\Models\Size','size_id');
    }
    public function color(){
        return $this->belongsTo('App\Models\Color','color_id');
    }
    public function product(){
        return $this->belongsTo('App\Models\Product','product_id');
    }
}

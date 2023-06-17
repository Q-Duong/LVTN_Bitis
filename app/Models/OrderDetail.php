<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'order_detail_quantity','ware_house_id','order_id'
     ];
    protected $primaryKey = 'order_detail_id';
 	protected $table = 'order_detail';

    public function order(){
        return $this->belongsTo('App\Models\Order','order_id');
    }
    public function wareHouse(){
        return $this->belongsTo('App\Models\WareHouse','ware_house_id');
    }
}

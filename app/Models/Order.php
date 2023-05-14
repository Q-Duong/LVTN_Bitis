<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $timestamps = true; //set time to false
    protected $fillable = [
    	'order_recceiver_name', 'order_recceiver_phone', 'order_recceiver_email','order_recceiver_address','order_total','order_status','order_is_paid','order_payment_type','user_id','employee_id'
    ];
    protected $primaryKey = 'order_id ';
 	protected $table = 'order';

 	// public function product(){
 	// 	return $this->belongsTo('App\Models\Product','product_id');
 	// }
}

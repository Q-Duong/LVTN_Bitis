<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $timestamps = true; //set time to false
    protected $fillable = [
    	'order_code','order_total','order_status','order_is_paid','order_payment_type'
    ];
    protected $primaryKey = 'order_id';
 	protected $table = 'order';

	public function receiver(){
        return $this->hasMany('App\Models\Receiver');
    }
	public function orderDetail(){
        $this->hasMany('App\Models\OrderDetail');
    }
}

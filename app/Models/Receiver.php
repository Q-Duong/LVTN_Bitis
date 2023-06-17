<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Receiver extends Model
{
    public $timestamps = true; //set time to false
    protected $fillable = [
    	'receiver_first_name', 'receiver_last_name', 'receiver_phone', 'receiver_email','receiver_address','receiver_note','city_id','district_id','ward_id','order_id'
    ];
    protected $primaryKey = 'receiver_id';
 	protected $table = 'receiver';

	public function city(){
        return $this->belongsTo('App\Models\City','city_id');
    }
	public function district(){
        return $this->belongsTo('App\Models\District','district_id');
    }
	public function ward(){
        return $this->belongsTo('App\Models\Ward','ward_id');
    }
	public function order(){
        return $this->belongsTo('App\Models\Order','order_id');
    }
}

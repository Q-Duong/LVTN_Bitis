<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    public $timestamps = true; //set time to false
    protected $fillable = [
    	'delivery_first_name', 'delivery_last_name', 'delivery_phone', 'delivery_email','delivery_address','city_id','district_id','ward_id','user_id'
    ];
    protected $primaryKey = 'delivery_id';
 	protected $table = 'delivery';

	public function city(){
        return $this->belongsTo('App\Models\City','city_id');
    }
	public function district(){
        return $this->belongsTo('App\Models\District','district_id');
    }
	public function ward(){
        return $this->belongsTo('App\Models\Ward','ward_id');
    }
	public function user(){
        return $this->belongsTo('App\Models\User','user_id');
    }
    
}

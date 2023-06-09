<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'city_name', 'type'
    ];
    protected $primaryKey = 'city_id';
 	protected $table = 'city';

    public function receiver(){
        return $this->hasMany('App\Models\Receiver');
    }
    public function delivery(){
        return $this->hasMany('App\Models\Delivery');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'ward_name', 'type', 'district_id'
    ];
    protected $primaryKey = 'ward_id';
 	protected $table = 'ward';

    public function receiver(){
        return $this->hasMany('App\Models\Receiver');
    }
    public function delivery(){
        return $this->hasMany('App\Models\Delivery');
    }
}

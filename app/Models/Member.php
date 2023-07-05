<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'member_id', 'member_firstname','member_lastname','member_phone','member_email','member_avatar'
    ];
    protected $primaryKey = 'member_id';
 	protected $table = 'member';

    public function user(){
        return $this->hasOne('App\Models\User');
    }
    public function order(){
        $this->hasMany('App\Models\Order');
    }
    public function delivery(){
        $this->hasMany('App\Models\Delivery');
    }
}

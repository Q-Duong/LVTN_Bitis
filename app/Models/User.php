<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'user_id', 'user_firstname','user_lastname','user_phone','user_email','account_id','user_avatar'
    ];
    protected $primaryKey = 'user_id';
 	protected $table = 'user';

    public function account(){
        return $this->belongsTo('App\Models\Account','account_id');
    }
    public function receiver(){
        $this->hasMany('App\Models\Receiver');
    }
}

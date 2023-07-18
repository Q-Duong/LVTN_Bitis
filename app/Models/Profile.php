<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
        'profile_id',
        'profile_firstname',
        'profile_lastname',
        'profile_phone',
        'profile_email',
        'profile_avatar',
        'date_of_birth',
        'sex'
    ];
    protected $primaryKey = 'profile_id';
    protected $table = 'profile';

    public function user()
    {
        return $this->hasOne('App\Models\User');
    }
    public function order()
    {
        return $this->hasMany('App\Models\Order');
    }
    public function delivery()
    {
        return $this->hasMany('App\Models\Delivery');
    }
}
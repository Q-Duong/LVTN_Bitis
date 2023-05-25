<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'user_id', 'user_firstname','user_lastname','user_phone','user_email','account_id','user_avatar'
    ];
    protected $primaryKey = 'user_id';
 	protected $table = 'user';
}

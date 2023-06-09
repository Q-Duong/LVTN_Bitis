<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'account_id', 'admin_name','admin_avatar'
    ];
    protected $primaryKey = 'admin_id';
 	protected $table = 'admin';
}

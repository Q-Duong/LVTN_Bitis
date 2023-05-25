<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'account_role ', 'account_username ','account_password','account_active'
    ];
    protected $primaryKey = 'account_id ';
 	protected $table = 'account';

    public function employee(){
        $this->hasOne('App\Models\Employee');
    }
}

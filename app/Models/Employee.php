<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'employee_name', 'employee_phone', 'employee_email	','employee_avatar	', 'account_id'
    ];
    protected $primaryKey = 'employee_id';
 	protected $table = 'employee';

    public function account(){
        return $this->belongsTo('App\Models\Account','account_id');
    }
    public function order(){
        $this->hasMany('App\Models\Order');
    }
}

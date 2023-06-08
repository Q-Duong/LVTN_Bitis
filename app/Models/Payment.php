<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'momo_id','payment_status','order_id'
    ];
    protected $primaryKey = 'payment_id';
 	protected $table = 'payment';

    //  public function product(){
    //     $this->hasMany('App\Models\Product');
    // }
}

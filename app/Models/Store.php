<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    public $timestamps = false;
    protected $fillable = [
          'store_address','store_email','store_phone','store_name'
    ];
 
    protected $primaryKey = 'store_id ';
 	protected $table = 'store';
     
}

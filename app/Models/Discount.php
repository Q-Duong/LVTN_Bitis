<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'discount_percent', 'discount_image'
    ];
    protected $primaryKey = 'discount_id';
 	protected $table = 'discount ';
}

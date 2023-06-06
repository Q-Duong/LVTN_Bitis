<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'color_name', 'color_value'
    ];
    protected $primaryKey = 'color_id';
 	protected $table = 'color';
	
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Infomation extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'info_contact', 'info_map'
    ];
    protected $primaryKey = 'info_id';
 	protected $table = 'infomation';
}

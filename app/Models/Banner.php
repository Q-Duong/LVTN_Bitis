<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    public $timestamps = true; //set time to false
    protected $fillable = [
    	'banner_image'
    ];
    protected $primaryKey = 'banner_id ';
 	protected $table = 'banner';
}

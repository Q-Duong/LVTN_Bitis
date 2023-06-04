<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'banner_image','banner_name'
    ];
    protected $primaryKey = 'banner_id';
 	protected $table = 'banner';
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'discount_name','discount_slug', 'discount_image'
    ];
    protected $primaryKey = 'discount_id';
 	protected $table = 'discount';

    public function product(){
        return $this->hasOne('App\Models\Product');
    }
}

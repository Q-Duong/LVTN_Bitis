<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    public $timestamps = true; //set time to false
    protected $fillable = [
    	'rating_star', 'rating_comment','product_detail_id','user_id'
    ];
    protected $primaryKey = 'rating_id';
 	protected $table = 'rating';
}

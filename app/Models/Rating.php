<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    public $timestamps = true; //set time to false
    protected $fillable = [
    	'rating_star', 'rating_comment','product_id','user_id','rating_status'
    ];
    protected $primaryKey = 'rating_id';
 	protected $table = 'rating';

    public function product(){
        return $this->belongsTo('App\Models\Product','product_id');
    }
    public function user(){
        return $this->belongsTo('App\Models\User','user_id');
    }
}

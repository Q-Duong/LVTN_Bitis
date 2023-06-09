<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'order_detail_quanity','product_detail_id','order_id'
     ];
    protected $primaryKey = 'order_detail_id';
 	protected $table = 'order_detail';

    //  public function category_post(){
    //     return $this->belongsTo('App\Models\CategoryPost','category_post_id');
    // }
}

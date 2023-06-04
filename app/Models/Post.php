<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'post_title','post_slug','post_content','post_status','post_image','category_post_id'
    ];
    protected $primaryKey = 'post_id';
 	protected $table = 'post';

    public function categoryPost(){
       return $this->belongsTo('App\Models\CategoryPost','category_post_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'message_name', 'message_email','message_content'
    ];
    protected $primaryKey = 'message_id';
 	protected $table = 'message';
}

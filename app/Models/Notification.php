<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification  extends Model
{
    public $timestamps = true; //set time to false
    protected $fillable = [
    	'notification_title', 'notification_content', 'notification_site','user_id'
    ];
    protected $primaryKey = 'notification_id';
 	protected $table = 'notification';
}

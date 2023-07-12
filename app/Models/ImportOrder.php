<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImportOrder extends Model
{
    public $timestamps = true; //set time to false
    protected $fillable = [
    	'import_order_total','user_id'
    ];
    protected $primaryKey = 'import_order_id';
 	protected $table = 'import_order';

    public function user(){
        return $this->belongsTo('App\Models\User','user_id');
    }
    public function importOrderDetail(){
        return $this->belongsTo('App\Models\ImportOrder');
    }
}

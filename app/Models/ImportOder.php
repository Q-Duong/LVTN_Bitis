<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImportOder extends Model
{
    public $timestamps = true; //set time to false
    protected $fillable = [
    	'import_order_total', 'employee_id'
    ];
    protected $primaryKey = 'import_order_id';
 	protected $table = 'import_order';

}

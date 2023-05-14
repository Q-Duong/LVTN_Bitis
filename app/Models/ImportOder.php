<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImportOder extends Model
{
    public $timestamps = true; //set time to false
    protected $fillable = [
    	'import_oder_total', 'employee_id '
    ];
    protected $primaryKey = 'import_oder_id ';
 	protected $table = 'import_oder';

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImportOderDetail extends Model
{
    public $timestamps = false;
    protected $fillable = [
          'import_oder_detail_price',  'import_oder_detail_quantity',  'import_oder_id ','ware_hourse_id '
    ];
    protected $primaryKey = 'import_oder_detail_id ';
      protected $table = 'import_oder_detail';
}

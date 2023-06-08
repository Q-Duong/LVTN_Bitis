<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImportOderDetail extends Model
{
    public $timestamps = false;
    protected $fillable = [
          'import_order_detail_price',  'import_order_detail_quantity',  'import_order_id','ware_hourse_id'
    ];
    protected $primaryKey = 'import_order_detail_id';
      protected $table = 'import_order_detail';
}

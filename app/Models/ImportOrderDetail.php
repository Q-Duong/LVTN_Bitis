<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImportOrderDetail extends Model
{
      public $timestamps = false;
      protected $fillable = [
            'import_order_detail_price',  'import_order_detail_quantity',  'import_order_id','ware_house_id'
      ];
      protected $primaryKey = 'import_order_detail_id';
      protected $table = 'import_order_detail';
      public function importOrder(){
            return $this->belongsTo('App\Models\ImportOrder','import_order_id');
      }
      public function wareHouse(){
            return $this->belongsTo('App\Models\WareHouse','ware_house_id');
      }
}

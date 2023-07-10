<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
      public $timestamps = false;
      protected $fillable = [
            'size_attribute'
      ];
      
      protected $primaryKey = 'size_id';
      protected $table = 'size';
      
      public function wareHouse(){
            return $this->hasMany("App\Model\WareHouse");
      }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Statistics extends Model
{
      public $timestamps = true;
      protected $fillable = [
            'order_date','total_quantity','total_price','total_sale'
      ];
      
      protected $primaryKey = 'statistics_id';
      protected $table = 'statistics';
}

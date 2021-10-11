<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id','user_id', 'sales_rep','remarks','customer_book'
      ];
      public function customer(){
      return $this->hasOne('App\Models\customer');

      }
}

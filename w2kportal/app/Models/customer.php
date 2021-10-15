<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
  use HasFactory;
  protected $fillable = [
    'customer_email', 'customer_fname', 'customer_lname', 'customer_status', 'reason_hold', 'reason_lost,reason_hold_date'
  ];

  public function order()
  {
    return $this->hasMany('App\Models\order');
  }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class projectManager extends Model
{
    protected $fillable = ['pm_fname', 'pm_lname'];
    use HasFactory;
}

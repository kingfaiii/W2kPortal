<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class service_inclusion extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
}

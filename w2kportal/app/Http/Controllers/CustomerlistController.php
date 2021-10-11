<?php

namespace App\Http\Controllers;
use App\Models\Customer;

use App\Models\customerlist;
use Illuminate\Http\Request;

class CustomerlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $home = Customer::all();
        return view('list',['home'=>$home]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\customerlist  $customerlist
     * @return \Illuminate\Http\Response
     */
    public function show(customerlist $customerlist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\customerlist  $customerlist
     * @return \Illuminate\Http\Response
     */
    public function edit(customerlist $customerlist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\customerlist  $customerlist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, customerlist $customerlist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\customerlist  $customerlist
     * @return \Illuminate\Http\Response
     */
    public function destroy(customerlist $customerlist)
    {
        //
    }
}

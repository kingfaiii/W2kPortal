<?php

namespace App\Http\Controllers;

use App\Models\won_customer;
use App\Models\book;
use App\Models\customer;

use Illuminate\Http\Request;

class WonCustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $information = won_customer::join('customers', 'won_customers.customer_id', '=', 'customers.id')
            ->join('service_packages', 'service_packages.id', '=', 'won_customers.package_id')
            ->where('won_customers.status', '=', 'won');

        return view('won', ['information' => $information->get()]);
    }

    public function woncustomerview($id)
    {

        $user = won_customer::join('customers', 'won_customers.customer_id', '=', 'customers.id')
            ->where('won_customers.customer_id', '=', $id);

        $information = won_customer::join('customers', 'won_customers.customer_id', '=', 'customers.id')
            ->join('books', 'won_customers.customer_id', '=', 'books.won_id')
            ->where('books.won_id', '=', $id);

        return view('customerwon', ['information' => $information->get(), 'user' => $user->get()]);
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
     * @param  \App\Models\won_customer  $won_customer
     * @return \Illuminate\Http\Response
     */
    public function show(won_customer $won_customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\won_customer  $won_customer
     * @return \Illuminate\Http\Response
     */
    public function edit(won_customer $won_customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\won_customer  $won_customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, won_customer $won_customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\won_customer  $won_customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(won_customer $won_customer)
    {
        //
    }
}

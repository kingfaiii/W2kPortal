<?php

namespace App\Http\Controllers;

use App\Models\Customer;

use App\Models\customerlist;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Client\Response as ClientResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerlistController extends Controller
{
    private $home;
    private $dynamicQuery;
    private $customers_table = 'customers';

    public function __construct()
    {
        $this->dynamicQuery = Customer::query();
        $this->home = Customer::all();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('list', ['home' => $this->home]);
    }


    public function queryCustomerList(Request $request)
    {
        $query = $request->all();

        if (empty($query['date_from']) && empty($query['date_to'])) {
            $query['date_from'] = date('Y-m-d', strtotime('first day of january this year')) . ' 00:00:00';
            $query['date_to']   = date('Y-m-d') . ' 23:59:59';
        } else {
            $query['date_from'] .=  ' 00:00:00';
            $query['date_to']   .= ' 23:59:59';
        }

        $results = $this->dynamicQuery->when($query['search_value'], function ($q, $role) {
            return $q->where('customer_fname', 'LIKE', '%' . $role . '%')
                ->orWhere('customer_lname', 'LIKE', '%' . $role . '%');
        })->when($query['order_by'], function ($q, $role) {
            return $q->orderBy($role, 'DESC');
        })->when($query['date_from'] && $query['date_to'],  function ($q) use ($query) {
            return $q->whereBetween('created_at', [$query['date_from'], $query['date_to']]);
        });

        return response()->json($results->get(), 200);
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

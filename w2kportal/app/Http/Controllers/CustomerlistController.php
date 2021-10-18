<?php

namespace App\Http\Controllers;

use App\Models\Customer;

use App\Models\customerlist;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerlistController extends Controller
{
    private $home;
    private $dynamicQuery;
    private $c_table = 'customers';

    public function __construct()
    {
        $this->home = DB::table('customers')
            ->select('customers.*', 'orders.remarks')
            ->leftJoin('orders', 'customers.last_activity', '=', 'orders.id');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        return view('list', [
            'home' => $this->home->get()
        ]);
    }


    public function queryCustomerList(Request $request)
    {
        $query = $request->all();

        if (!empty($query['date_from']) && !empty($query['date_to'])) {
            $query['date_from'] .=  ' 00:00:00';
            $query['date_to']   .= ' 23:59:59';
        }


        $results = $this->home->when(!empty($query['search_value']), function ($q) use ($query) {
            return $q->where('customers.customer_fname', 'LIKE', '%' . trim($query['search_value']) . '%')
                ->orWhere('customers.customer_lname', 'LIKE', '%' . trim($query['search_value']) . '%')
                ->orWhere('customers.customer_email', 'LIKE', '%' . trim($query['search_value']) . '%')
                ->orWhere('customers.customer_status', 'LIKE', '%' . trim($query['search_value']) . '%')
                ->orWhere('orders.remarks', 'LIKE', '%' . trim($query['search_value']) . '%');
        })->when($query['order_by'], function ($q) use ($query) {
            return $q->orderBy('customers.' . $query['order_by'], 'DESC');
        })->when($query['date_from'] && $query['date_to'], function ($q) use ($query) {
            return $q->whereBetween('customers.created_at', [$query['date_from'], $query['date_to']]);
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

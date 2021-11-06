<?php

namespace App\Http\Controllers;

use App\Models\won_customer;
use Illuminate\Support\Facades\DB;
use App\Models\book;
use App\Models\customer;

use Illuminate\Http\Request;

class WonCustomerController extends Controller
{
    public $id;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    Public function __construct()
    {
        
        
            $this->middleware('auth');

            function getIndex(){
                
            $information = DB::table('won_customers')
            ->join('customers', 'won_customers.customer_id', '=', 'customers.id')
            ->join('service_packages', 'service_packages.id', '=', 'won_customers.package_id')
            ->where('won_customers.status', '=', 'won')
            ->get();

              return view('won', ['information' => $information]);
            }
    }

    public function index()
    {
       return getIndex();
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

}

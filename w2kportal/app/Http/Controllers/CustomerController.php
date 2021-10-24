<?php

namespace App\Http\Controllers;

use App\Models\won_customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index($id)
    {
        $information = won_customer::join('customers', 'won_customers.customer_id', '=', 'customers.id')
            ->join('service_packages', 'service_packages.id', '=', 'won_customers.package_id')
            ->select(
                'customers.id',
                'customers.customer_lname',
                'customers.customer_lname',
                'customers.created_at AS customer_createdAt',
                'customers.customer_email',
                'won_customers.created_at AS won_createdAt',
                'won_customers.transaction_ID',
                'won_customers.book_title',
                'service_packages.package_name'
            )
            ->where('won_customers.status', '=', 'won')->where('customers.id', '=', $id);

        return View('customerinput', ['information' =>  $information->get()]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\won_customer;
use App\Models\book;
use App\Models\service_package;
use App\Models\service_inclusion;
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


        $book_information = service_inclusion::join('service_packages', 'service_inclusions.package_id', '=', 'service_packages.id')
            ->where('service_inclusions.book_id', '=', $id);

        $customer_information = book::join('won_customers', 'books.won_id', '=', 'won_customers.customer_id')
            ->join('service_packages', 'won_customers.package_id', '=', 'service_packages.id')
            ->join('customers', 'won_customers.customer_id', '=', 'customers.id')
            ->select(
                'customers.id',
                'customers.customer_lname',
                'customers.customer_lname',
                'books.transaction_ID',
                'books.book_title',
                'customers.created_at AS customer_createdAt',
                'customers.customer_email',
                'won_customers.created_at AS won_createdAt',
                'service_packages.package_name'
            )
            // ->where('won_customers.status', '=', 'won')
            ->where('books.id', '=', $id);

        return View('customerinput', ['customer_information' =>  $customer_information->get(), 'book_information' => $book_information->get()]);
    }
}

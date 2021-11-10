<?php

namespace App\Http\Controllers;

use App\Models\won_customer;
use App\Models\service_inclusion;
use Illuminate\Support\Facades\DB;
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
        $information = won_customer::join(
            'customers',
            'won_customers.customer_id',
            '=',
            'customers.id'
        )
            ->join(
                'service_packages',
                'service_packages.id',
                '=',
                'won_customers.package_id'
            )
            ->where('won_customers.status', '=', 'won')
            ->get();

        return view('won', ['information' => $information]);
    }

    public function woncustomerview($id)
    {
        $user = won_customer::join(
            'customers',
            'won_customers.customer_id',
            '=',
            'customers.id'
        )->where('won_customers.customer_id', '=', $id);

        $information = won_customer::join(
            'customers',
            'won_customers.customer_id',
            '=',
            'customers.id'
        )
            ->join('books', 'won_customers.customer_id', '=', 'books.won_id')
            ->where('books.won_id', '=', $id);

        return view('customerwon', [
            'information' => $information->get(),
            'user' => $user->get(),
        ]);
    }
    public function wonGetAdmin()
    {
        $getServiceInclusion = service_inclusion::join(
            'won_customers',
            'service_inclusions.won_id',
            '=',
            'won_customers.id'
        )
            ->join(
                'customers',
                'won_customers.customer_id',
                '=',
                'customers.id'
            )
            ->join('books', 'won_customers.id', '=', 'books.won_id')
            ->select(
                'service_inclusions.*',
                'customers.customer_fname AS custFname',
                'customers.customer_lname AS custLname',
                'books.total_project_cost AS cost',
                'books.book_title AS bookTitle',
                'books.id AS bookID'
            )
            ->where('service_inclusions.status', 'on-Going')
            ->whereNull('service_inclusions.owner')
            ->get();

        return view('won_sorted_admin', [
            'getServiceInclusion' => $getServiceInclusion,
        ]);
    }
    public function wonGetSupport()
    {
        $getServiceInclusion = service_inclusion::join(
            'won_customers',
            'service_inclusions.won_id',
            '=',
            'won_customers.id'
        )
            ->join(
                'customers',
                'won_customers.customer_id',
                '=',
                'customers.id'
            )
            ->join('books', 'won_customers.id', '=', 'books.won_id')
            ->select(
                'service_inclusions.*',
                'customers.customer_fname AS custFname',
                'customers.customer_lname AS custLname',
                'books.total_project_cost AS cost',
                'books.book_title AS bookTitle',
                'books.id AS bookID'
            )
            ->where('service_inclusions.status', 'on-Going')
            ->whereNull('service_inclusions.date_assigned')
            ->get();

        return view('won_sorted_support', [
            'getServiceInclusion' => $getServiceInclusion,
        ]);
    }
}

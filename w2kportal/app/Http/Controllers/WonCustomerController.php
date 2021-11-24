<?php

namespace App\Http\Controllers;

use App\Models\won_customer;
use App\Models\service_inclusion;
use Illuminate\Support\Facades\DB;
use App\Models\book;
use App\Models\customer;
use App\Models\inclusions_log;
use App\Models\owner;
use Illuminate\Http\Request;

class WonCustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $info_book;
    public function __construct()
    {
        $this->info_book = won_customer::join(
            'customers',
            'won_customers.customer_id',
            '=',
            'customers.id'
        )->where('won_customers.status', '=', 'won');
    }

    public function index()
    {
        $request = request()->input();
        $information = $this->info_book->when(
            array_key_exists('request_data', $request),
            function ($q) use ($request) {
                return $q->where(function ($q) use ($request) {
                    return $q
                        ->where(
                            'customers.customer_fname',
                            'LIKE',
                            '%' . trim($request['request_data']) . '%'
                        )
                        ->orWhere(
                            'customers.customer_lname',
                            'LIKE',
                            '%' . trim($request['request_data']) . '%'
                        )
                        ->orWhere(
                            'customers.customer_email',
                            'LIKE',
                            '%' . trim($request['request_data']) . '%'
                        );
                });
            }
        );

        if (array_key_exists('request_data', $request)) {
            return response()->json($information->get()->toArray(), 200);
        } else {
            return view('won', ['information' => $information->get()]);
        }
    }

    public function woncustomerview($id)
    {
        $user = won_customer::join(
            'customers',
            'won_customers.customer_id',
            '=',
            'customers.id'
        )->where('won_customers.customer_id', '=', $id);

        $information = $this->find_wonCustomer_by_won_id($id);

        return view('customerwon', [
            'information' => $information->get(),
            'user' => $user->get(),
        ]);
    }

    private function find_wonCustomer_by_won_id($id)
    {
        return won_customer::join(
            'customers',
            'won_customers.customer_id',
            '=',
            'customers.id'
        )
            ->join('books', 'won_customers.customer_id', '=', 'books.won_id')
            ->where('books.won_id', '=', $id);
    }

    public function wonGetAdmin()
    {
        $ownerInformation = owner::all();
        $getServiceInclusion = service_inclusion::leftJoin(
            'won_customers',
            'service_inclusions.won_id',
            '=',
            'won_customers.customer_id'
        )
            ->leftJoin(
                'customers',
                'won_customers.customer_id',
                '=',
                'customers.id'
            )
            ->leftJoin('books', 'service_inclusions.book_id', '=', 'books.id')
            ->select(
                'service_inclusions.*',
                'service_inclusions.id AS serID',
                'customers.customer_fname AS custFname',
                'customers.customer_lname AS custLname',
                'books.total_project_cost AS cost',
                'books.book_title AS bookTitle',
                'books.id AS bookID'
            )
            ->where('service_inclusions.status', 'On-going')
            ->whereNull('service_inclusions.owner')
            ->get();
        // ->toArray();

        return view('won_sorted_admin', [
            'getServiceInclusion' => $getServiceInclusion,
            'ownerInformation' => $ownerInformation,
        ]);
    }
    public function wonGetSupport()
    {
        $getServiceInclusion = service_inclusion::leftJoin(
            'won_customers',
            'service_inclusions.won_id',
            '=',
            'won_customers.customer_id'
        )
            ->join(
                'customers',
                'won_customers.customer_id',
                '=',
                'customers.id'
            )
            ->join('books', 'service_inclusions.book_id', '=', 'books.id')
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
            ->whereNotNull('service_inclusions.owner')
            ->get();

        return view('won_sorted_support', [
            'getServiceInclusion' => $getServiceInclusion,
        ]);
    }
    public function adminUpdate($id)
    {
        $updateInformation = service_inclusion::find($id);
        $updateInformation->owner = request('owner');
        $updateInformation->owner_by = auth()->user()->id;
        $updateInformation->job_cost = request('job_cost');
        $updateInformation->job_cost_by = auth()->user()->id;
        $updateInformation->update();

        $adminLog = new inclusions_log();
        $adminLog->log_id = $updateInformation['id'];
        $adminLog->user_id = auth()->user()->id;
        $adminLog->won_id = $updateInformation['won_id'];
        $adminLog->package_id = $updateInformation['package_id'];
        $adminLog->book_id = $updateInformation['book_id'];
        $adminLog->owner = request('owner');
        $adminLog->owner_by = auth()->user()->id;
        $adminLog->job_cost = request('job_cost');
        $adminLog->job_cost_by = auth()->user()->id;
        $adminLog->save();
        return back();
    }

    public function supportUpdate($id)
    {
        $supportUpdateInformation = service_inclusion::find($id);
        $supportUpdateInformation->date_assigned_old = 'value';
        $supportUpdateInformation->date_assigned = request('date_assigned');
        $supportUpdateInformation->date_assigned_by = auth()->user()->id;
        $supportUpdateInformation->update();

        $supportLog = new inclusions_log();
        $supportLog->log_id = $supportUpdateInformation['id'];
        $supportLog->user_id = auth()->user()->id;
        $supportLog->won_id = $supportUpdateInformation['won_id'];
        $supportLog->package_id = $supportUpdateInformation['package_id'];
        $supportLog->book_id = $supportUpdateInformation['book_id'];
        $supportLog->date_assigned = request('date_assigned');
        $supportLog->date_assigned_by = auth()->user()->id;
        $supportLog->save();
        return bacK();
    }
}

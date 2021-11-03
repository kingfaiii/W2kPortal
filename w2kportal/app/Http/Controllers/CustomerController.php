<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\book;
use App\Models\inclusions_log;
use App\Models\owner;
use App\Models\QualityAssurance;
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
            ->select('service_inclusions.*', 'service_inclusions.id AS serID')
            ->where('service_inclusions.book_id', '=', $id);

        $customer_information = book::join('won_customers', 'books.won_id', '=', 'won_customers.customer_id')
            ->join('service_packages', 'won_customers.package_id', '=', 'service_packages.id')
            ->join('customers', 'won_customers.customer_id', '=', 'customers.id')
            ->select(

                'customers.id',
                'customers.customer_fname',
                'customers.customer_lname',
                'books.transaction_ID',
                'books.book_title',
                'customers.created_at AS customer_createdAt',
                'customers.customer_email',
                'won_customers.created_at AS won_createdAt',
                'books.total_project_cost AS cost',
                'service_packages.package_name'
            )
            // ->where('won_customers.status', '=', 'won')
            ->where('books.id', '=', $id);

        $inclusions_backlog = inclusions_log::orderBy('created_at', 'DESC')->where('book_id', $id)->limit(1)->get();

        $owner = owner::all();
        $qa = QualityAssurance::all();

        $book_info = [];
        foreach ($book_information->get()->toArray() as $key => $books) {
            foreach ($books as $book_key => $book) {

                $book_info[$key][$book_key] = explode('*', $book)[0] ? explode('*', $book)[0] : '';
            }
        }

        return View('customerinput', [
            'customer_information' =>  $customer_information->get(),
            'book_information' => $book_info,
            'owner' => $owner, 'qa' => $qa,
            "history" => $inclusions_backlog
        ]);
    }

    public function update(request $request)
    {
        $request_items = [];

        $request_items = array_map('array_filter', request()->input('items'));
        $request_items = array_filter($request_items);

        if (!empty($request_items)) {
            foreach ($request_items as $key => $inclusions) {
                $service = service_inclusion::where('id', $inclusions['service_id']);
                unset($inclusions['service_id']);

                foreach ($inclusions as $key => $inclusion) {
                    $inclusions[$key] .= '*' . Auth::user()->id;
                }

                $service->update($inclusions);
            }
        }


        $this->create_logs($request_items);

        return response()->json(["msg" => true], 200);
    }


    public function create_logs($user_logs)
    {
        if (!empty($user_logs)) {
            foreach ($user_logs as $key => $inclusions) {
                $service = service_inclusion::where('id', $inclusions['service_id'])->get();
                $service_array = $service->toArray()[0];

                $inclusions['id'] =  $inclusions['service_id'];
                $inclusions['won_id'] = $service_array['won_id'];
                $inclusions['book_id'] = $service_array['book_id'];
                $inclusions['package_id'] = $service_array['package_id'];
                unset($inclusions['service_id']);

                inclusions_log::insert([
                    "service_id" =>  $inclusions['id'],
                    "updated_by" => Auth::user()->id,
                    "won_id" =>  $inclusions['won_id'],
                    "book_id" => $inclusions['book_id'],
                    "package_id" =>  $inclusions['package_id']
                ]);
            }
        }
    }
    public function historyIndex($id)
    {


        $history = inclusions_log::join('books', 'inclusions_logs.book_id', '=', 'books.id')
            ->join('service_inclusions', 'inclusions_logs.service_id', '=', 'service_inclusions.id')
            ->where('inclusions_logs.book_id', '=', $id);

        return view('InclusionHistory', ['history' => $history]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\book;
use App\Models\inclusions_log;
use App\Models\owner;
use App\Models\QualityAssurance;
use App\Models\service_inclusion;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CustomerController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index($id)
    {
        // Retrieving The History Information
        $inclusions_backlog = inclusions_log::orderBy('created_at', 'DESC')->where('book_id', $id)->limit(1)->get();

        // Retrieving All the Owners Data
        $owner = owner::all();

        // Retrieving All the QA Data
        $qa = QualityAssurance::all();

        // Retrieving the Service Inclusions
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
            ->where('books.id', '=', $id);

        

        $book_info = [];
        foreach ($book_information->get()->toArray() as $key => $books) {
            foreach ($books as $book_key => $book) {

                $book_info[$key][$book_key] = $book;
            }
        }

        return View('customerinput', [
            'customer_information' =>  $customer_information->get(),
            'book_information' =>  $book_info,
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
                $service_new = service_inclusion::where('id', $inclusions['service_id'])->get();

                $service_array = $service_new->toArray()[0];
                unset($inclusions['service_id']);

                foreach ($service_array as $service_key => $inclusion) {
                    $current_user = explode('*', $service_array[$service_key]);

                    if (array_key_exists($service_key, $inclusions)) {

                        if (count($current_user) > 1) {

                            if ($current_user[1] === strval(Auth::user()->id) && isset(explode('*', $inclusions[$service_key])[1])) {
                                $inclusions[$service_key] =  $service_array[$service_key];
                            } else {
                                if (isset(explode('*', $inclusions[$service_key])[1])) {
                                    $inclusions[$service_key] = explode('*',  $inclusions[$service_key])[0] . '*' . $current_user[1];
                                } else {
                                    $inclusions[$service_key] = explode('*',  $inclusions[$service_key])[0] . '*' .  Auth::user()->id;
                                }
                            }
                        } else {
                            $inclusions[$service_key] .= '*' . Auth::user()->id;
                        }
                    }
                }

                $service->update($inclusions);
            }

            $this->create_logs($request_items);
        }



        return response()->json(["msg" => true], 200);
    }


    public function create_logs($user_logs)
    {
        if (!empty($user_logs)) {
            foreach ($user_logs as $key => $inclusions) {

                $service = service_inclusion::where('id', $inclusions['service_id'])->get();
                $service_array = $service->toArray()[0];
                unset($inclusions['service_id']);
                foreach ($service_array as $ser_key => $inclusion) {

                    $current_user = explode('*', $service_array[$ser_key]);

                    if (array_key_exists($ser_key, $inclusions)) {
                        if (count($current_user) > 1) {

                            if ($current_user[1] === strval(Auth::user()->id) && str_contains('*', $inclusions[$ser_key])) {
                                $inclusions[$ser_key] =  $service_array[$ser_key];
                            } else {
                                if (isset(explode('*', $inclusions[$ser_key])[1])) {
                                    unset($inclusions[$ser_key]);
                                } else {
                                    $inclusions[$ser_key] = explode('*',  $inclusions[$ser_key])[0] . '*' .  Auth::user()->id;
                                }
                            }
                        } else {
                            $inclusions[$ser_key] .= '*' . Auth::user()->id;
                        }
                    }
                }

                if (!empty($inclusions)) {
                    $inclusions['log_id'] = $service_array['id'];
                    $inclusions['won_id'] = $service_array['won_id'];
                    $inclusions['book_id'] = $service_array['book_id'];
                    $inclusions['package_id'] = $service_array['package_id'];
                    $inclusions['user_id'] = Auth::user()->id;
                    $inclusions['created_at'] = Carbon::now()->toDateTimeString();
                    $inclusions['updated_at'] = Carbon::now()->toDateTimeString();
                    inclusions_log::insert($inclusions);
                }
            }
        }
    }
}

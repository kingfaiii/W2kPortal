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

    private $inclusions_columns_ref;
    private $inclusions_field;
    private $user_updated;
    //
    public function __construct()
    {

        $this->inclusions_field = [
            'layout',
            'page_count',
            'project_classification',
            'turnaround_time',
            'status',
            'commitment_date',
            'owner',
            'job_cost',
            'date_assigned',
            'date_completed',
            'quality_assurance',
            'quality_score',
            'uid',
            'project_link'
        ];

        $this->user_updated = [
            'layout_by',
            'page_count_by',
            'project_classification_by',
            'turnaround_time_by',
            'status_by',
            'commitment_date_by',
            'owner_by',
            'job_cost_by',
            'date_assigned_by',
            'date_completed_by',
            'quality_assurance_by',
            'quality_score_by',
            'uid_by',
            'project_link_by'
        ];
    }


    public function index($id)
    {
        // Retrieving The History Information
        $inclusions_backlog = inclusions_log::where('book_id', $id)->latest()->limit(1)->get();

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

        return View('customerinput', [
            'customer_information' =>  $customer_information->get(),
            'book_information' =>  $book_information->get()->toArray(),
            'owner' => $owner, 'qa' => $qa,
            "history" => $inclusions_backlog
        ]);
    }

    public function update(request $request)
    {
        $request_items = request()->input('items');
        if (!empty($request_items)) {
            foreach ($request_items as $key => $inclusions) {
                $service = service_inclusion::where('id', $inclusions['service_id']);
                $service_new = service_inclusion::where('id', $inclusions['service_id'])
                    ->select($this->inclusions_field)
                    ->get();

                $updated_by_columns = service_inclusion::where('id', $inclusions['service_id'])->select($this->user_updated)->get()->toArray()[0];

                $service_array = $service_new->toArray()[0];
                unset($inclusions['service_id']);

                foreach ($service_array as $service_key => $inclusion) {
                    foreach ($updated_by_columns as $owner_key => $owner) {
                        if (array_key_exists($service_key, $inclusions) || array_key_exists($owner_key, $inclusions)) {
                            if (empty($service_array[$service_key]) && !empty($inclusions[$service_key]) && empty($updated_by_columns[$owner_key])) {
                                if (str_contains($owner_key, $service_key)) {
                                    $inclusions[$owner_key] =  Auth::user()->id;
                                }
                            } else if ($service_array[$service_key] !== $inclusions[$service_key] && $updated_by_columns[$owner_key] !== strval(Auth::user()->id)) {
                                if (str_contains($owner_key, $service_key)) {
                                    $inclusions[$owner_key] =  Auth::user()->id;
                                }
                            } else if ($service_array[$service_key] === $inclusions[$service_key] && $updated_by_columns[$owner_key] === strval(Auth::user()->id)) {
                                if (str_contains($owner_key, $service_key)) {
                                    $inclusions[$owner_key] = $updated_by_columns[$owner_key];
                                    $inclusions[$owner_key] = $updated_by_columns[$owner_key];
                                }
                            } else if ($service_array[$service_key] !== $inclusions[$service_key] && $updated_by_columns[$owner_key] === strval(Auth::user()->id)) {
                                if (str_contains($owner_key, $service_key)) {
                                    $inclusions[$owner_key] =  Auth::user()->id;
                                }
                            }
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
        // ALGORITHM SHOULD BE IF PAST DATA !== CURRENT DATA AND PAST ID === CURRENT_ID.

        if (!empty($user_logs)) {
            foreach ($user_logs as $key => $inclusions) {
                asort($inclusions);
                $service_new = service_inclusion::where('id', $inclusions['service_id'])
                    ->select($this->inclusions_field)
                    ->get();

                $get_foreign_ids = service_inclusion::where('id', $inclusions['service_id'])
                    ->select('id', 'won_id', 'book_id', 'package_id')
                    ->get()->toArray()[0];

                $updated_by_columns = service_inclusion::where('id', $inclusions['service_id'])->select($this->user_updated)->get()->toArray()[0];

                $service_array = $service_new->toArray()[0];
                unset($inclusions['service_id']);

                foreach ($service_array as $service_key => $inclusion) {
                    foreach ($updated_by_columns as $owner_key => $owner) {
                        if (array_key_exists($service_key, $inclusions) || array_key_exists($owner_key, $inclusions)) {
                            if (!empty($inclusions[$service_key]) && $updated_by_columns[$owner_key] === strval(Auth::user()->id)) {
                                if (str_contains($owner_key, $service_key)) {
                                    $inclusions[$owner_key] = Auth::user()->id;
                                }
                            }
                        }

                        if (!empty($inclusions[$service_key]) && $updated_by_columns[$owner_key] !== strval(Auth::user()->id)) {
                            if (str_contains($owner_key, $service_key)) {
                                unset($inclusions[$owner_key]);
                                unset($inclusions[$service_key]);
                            }
                        }
                    }
                }

                foreach ($inclusions as $inc_key => $inc) {
                    if (empty($inc)) {
                        unset($inclusions[$inc_key]);
                    }
                }

                if (!empty($inclusions)) {
                    $inclusions['log_id'] = $get_foreign_ids['id'];
                    $inclusions['won_id'] = $get_foreign_ids['won_id'];
                    $inclusions['book_id'] = $get_foreign_ids['book_id'];
                    $inclusions['package_id'] = $get_foreign_ids['package_id'];
                    $inclusions['user_id'] = Auth::user()->id;
                    $inclusions['created_at'] = Carbon::now()->toDateTimeString();
                    $inclusions['updated_at'] = Carbon::now()->toDateTimeString();
                    inclusions_log::insert($inclusions);
                }
            }
        }
    }
}

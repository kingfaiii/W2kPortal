<?php

namespace App\Http\Controllers;

use App\Models\won_customer;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Book;
use App\Models\service_inclusion;
use App\Models\service_package;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;

class OrderController extends Controller
{
    //
    private $inclusions_array = [
        [
            "service_name" => "Interior Formatting",
            "project_cost" => 150,
            "task" => "Interior Formatting",
            "parent" => 1,
            "calculate" => 0
        ],

        [
            "service_name" => "Premium Book Cover Art",
            "project_cost" => 100,
            "task" => "Art Work - Cover",
            "parent" => 1,
            "calculate" => 0
        ],

        [
            "service_name" => "Ebook Conversion",
            "project_cost" => 0,
            "task" => "Conversion",
            "parent" => 1,
            "calculate" => 1
        ],

        [
            "service_name" => "Amazon Ebook Upload",
            "project_cost" => 50,
            "task" => "eBook Upload",
            "parent" => 1,
            "calculate" => 0
        ],

        [
            "service_name" => "Amazon Print Upload",
            "project_cost" => "",
            "task" => "Print Upload",
            "parent" => 1,
            "calculate" => 0
        ],

        [
            "service_name" => "Facebook Banner",
            "project_cost" => "",
            "task" => "Art Work - FB Cover",
            "parent" => 1,
            "calculate" => 0
        ],

        [
            "service_name" => "Facebook Page Creation",
            "project_cost" => 50,
            "task" => "FB Page Creation",
            "parent" => 1,
            "calculate" => 0
        ],

        [
            "service_name" => "eBook Conversion (EB)",
            "project_cost" => 0,
            "task" => "Conversion",
            "parent" => 2,
            "calculate" => 1
        ],

        [
            "service_name" => "Basic eBook Cover Art (EB)",
            "project_cost" => 0,
            "task" => "Art Work - Cover",
            "parent" => 2,
            "calculate" => 0
        ],


        [
            "service_name" => "eBook Conversion (EV)",
            "project_cost" => 0,
            "task" => "Conversion",
            "parent" => 3,
            "calculate" => 1
        ],

        [
            "service_name" => "Basic eBook Cover Art (EV)",
            "project_cost" => 0,
            "task" => "Art Work - Cover",
            "parent" => 3,
            "calculate" => 0
        ],

        [
            "service_name" => "Facebook Banner (EV)",
            "project_cost" => 0,
            "task" => "Art Work - FB Cover",
            "parent" => 3,
            "calculate" => 0
        ],

        [
            "service_name" => "Facebook Page Creation",
            "project_cost" => 50,
            "task" => "FB Page Creation",
            "parent" => 3,
            "calculate" => 0
        ],

        [
            "service_name" => "eBook Conversion (ED)",
            "project_cost" => 0,
            "task" => "Conversion",
            "parent" => 4,
            "calculate" => 1
        ],

        [
            "service_name" => "Premium eBook Cover Art (ED)",
            "project_cost" => 100,
            "task" => "Art Work - Cover",
            "parent" => 4,
            "calculate" => 0
        ],

        [
            "service_name" => "Amazon eBook Upload (ED)",
            "project_cost" => 50,
            "task" => "eBook Upload",
            "parent" => 4,
            "calculate" => 0
        ],

        [
            "service_name" => "Facebook Banner (ED)",
            "project_cost" => 0,
            "task" => "Art Work - FB Cover",
            "parent" => 4,
            "calculate" => 0
        ],


        [
            "service_name" => "Facebook Page Creation (ED)",
            "project_cost" => 50,
            "task" => "FB Page Creation",
            "parent" => 4,
            "calculate" => 0
        ],

        [
            "service_name" => "Interior Formatting (PB)",
            "project_cost" => 0,
            "task" => "Interior Formatting",
            "parent" => 5,
            "calculate" => 1
        ],

        [
            "service_name" => "Interior Formatting (PV)",
            "project_cost" => 0,
            "task" => "Interior Formatting",
            "parent" => 6,
            "calculate" => 1
        ],


        [
            "service_name" => "Premium Book Covert Art (PV)",
            "project_cost" => 100,
            "task" => "Interior Formatting",
            "parent" => 6,
            "calculate" => 0
        ],

        [
            "service_name" => "Interior Formatting (PD)",
            "project_cost" => 0,
            "task" => "Interior Formatting",
            "parent" => 7,
            "calculate" => 1
        ],


        [
            "service_name" => "Premium Book Cover Art (PD)",
            "project_cost" => 100,
            "task" => "Art Work - Cover",
            "parent" => 7,
            "calculate" => 0
        ],


        [
            "service_name" => "Amazon Print Upload (PD)",
            "project_cost" => 50,
            "task" => "Print Upload",
            "parent" => 7,
            "calculate" => 0
        ],

        [
            "service_name" => "Facebook Banner (PD)",
            "project_cost" => 0,
            "task" => "Art Work - FB Cover",
            "parent" => 7,
            "calculate" => 0
        ],

        [
            "service_name" => "Facebook Page Creation (PD)",
            "project_cost" => 50,
            "task" => "FB Page Creation",
            "parent" => 7,
            "calculate" => 0
        ],

        [
            "service_name" => "Interior Formatting (EPB)",
            "project_cost" => 0,
            "task" => "Interior Formatting",
            "parent" => 8,
            "calculate" => 1
        ],


        [
            "service_name" => "eBook Conversion (EPB)",
            "project_cost" => 80,
            "task" => "Conversion",
            "parent" => 8,
            "calculate" => 0
        ],

        [
            "service_name" => "Basic eBook Cover Art (EPB)",
            "project_cost" => 0,
            "task" => "Art Work - Cover",
            "parent" => 8,
            "calculate" => 0
        ],


        [
            "service_name" => "Interior Formatting (EPV)",
            "project_cost" => 0,
            "task" => "Interior Formatting",
            "parent" => 9,
            "calculate" => 1
        ],


        [
            "service_name" => "eBook Conversion (EPV)",
            "project_cost" => 100,
            "task" => "Art Work - Cover",
            "parent" => 9,
            "calculate" => 0
        ],

        [
            "service_name" => "Basic eBook Cover Art (EPV)",
            "project_cost" => 49,
            "task" => "Conversion",
            "parent" => 9,
            "calculate" => 0
        ],


        [
            "service_name" => "Web Design",
            "project_cost" => 0,
            "task" => "Web Creation",
            "parent" => 10,
            "calculate" => 1
        ],


        [
            "service_name" => "Physical to Digital",
            "project_cost" => 0,
            "task" => "Physical to Digital",
            "parent" => 11,
            "calculate" => 0
        ],


        [
            "service_name" => "Physical to eBook",
            "project_cost" => 0,
            "task" => "Physical to eBook",
            "parent" => 11,
            "calculate" => 0
        ],

        [
            "service_name" => "Copyediting",
            "project_cost" => 0,
            "task" => "Copyediting",
            "status" => "On-Hold",
            "parent" => 12,
            "calculate" => 0
        ],

        [
            "service_name" => "Proofreading",
            "project_cost" => 0,
            "task" => "Proofreading",
            "status" => "On-Hold",
            "parent" => 12,
            "calculate" => 0
        ],

        [
            "service_name" => "Development Editing",
            "project_cost" => 0,
            "task" => "Development Editing",
            "status" => "On-Hold",
            "parent" => 12,
            "calculate" => 0
        ],
    ];

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (session('success')) {
                Alert::success(session('success'));
            }
            if (session('deleted')) {
                Alert::success(session('deleted'));
            }
            if (session('updateactivity')) {
                Alert::success(session('updateactivity'));
            }
            return $next($request);
        });
    }

    public function index($id)
    {
        // $order = Order::join("customers", function ($join) {
        //     $join->on("customers.id", "=", "orders.id");
        // })->where('orders.id',$id)->get();

        $order = Order::leftJoin('service_packages', 'orders.Package_id', '=', 'service_packages.id')
            ->select('orders.*', 'service_packages.*', 'orders.updated_at AS orderupdated', 'orders.Package_id AS PackID', 'orders.id AS ActivityID')
            ->where('customer_id', $id)
            ->get();

        $customer = Customer::all()
            ->where('id', $id);

        $packages = service_package::all();




        //$save = $order->sales_rep;
        return view('order', ['order' => $order, 'customer' => $customer, 'packages' => $packages])->with("id", $id);
        //dd($order);
    }

    public function Store(request $request)
    {
        $request->validate([
            'customer_id' => 'required',
            'user_id' => 'required',
            'sales_rep' => 'required',
            'remarks' => 'required',

        ]);
        $last_activity = Order::create($request->all());
        $status = customer::find(request()->input('customer_id'));
        $status->last_activity = $last_activity['id'];
        $status->customer_status = "Answered";
        $status->reason_hold = null;
        $status->reason_lost = null;
        $status->reason_hold_date = null;
        $status->update();
        return back();
    }
    public function show()
    {
        return view('order');
    }
    public function update(request $request, $id)
    {

        // $status = Customer::all()

        // ->where('id',$id);
        $status = customer::find($id);
        if (request()->input('customer_status') == "Answered") {
            $status->reason_hold = null;
            $status->reason_lost = null;
            $status->reason_hold_date = null;
            $status->customer_status = request()->input('customer_status');
            $status->update();

            $activity = new Order;
            $activity->created_at = Carbon::now()->toDateTimeString();
            $activity->updated_at = Carbon::now()->toDateTimeString();
            $activity->customer_id = request()->input('updatestatuscustomerid');
            $activity->user_id = request()->input('updatestatususerid');
            $activity->sales_rep = request()->input('updatestatususername');
            $activity->remarks = "Update Status(Answered)";
            $activity->save();
        } elseif (request()->input('customer_status') == "Lost") {
            $status->reason_hold = null;
            $status->reason_hold_date = null;
            $status->reason_lost = request()->input('Reasonlost');
            $status->customer_status = request()->input('customer_status');
            $status->update();
            // For Remarks
            $activity = new Order;
            $activity->created_at = Carbon::now()->toDateTimeString();
            $activity->updated_at = Carbon::now()->toDateTimeString();
            $activity->customer_id = request()->input('updatestatuscustomerid');
            $activity->user_id = request()->input('updatestatususerid');
            $activity->sales_rep = request()->input('updatestatususername');
            $activity->remarks = "Update Status (Lost)";
            $activity->save();
        } elseif (request()->input('customer_status') == "Hold") {
            $status->reason_lost = null;
            $status->reason_hold = request()->input('reason_hold');
            $status->reason_hold_date = request()->input('reason_hold_date');
            $status->customer_status = request()->input('customer_status');
            $status->update();

            $activity = new Order;
            $activity->created_at = Carbon::now()->toDateTimeString();
            $activity->updated_at = Carbon::now()->toDateTimeString();
            $activity->customer_id = request()->input('updatestatuscustomerid');
            $activity->user_id = request()->input('updatestatususerid');
            $activity->sales_rep = request()->input('updatestatususername');
            $activity->remarks = "Update Status (Hold)";
            $activity->save();
        }


        //$customer->update($request->all());
        return back()->with('success', 'Customer status Successfully Updated');
    }

    public function updateactivity($id)
    {
        $activity = Order::find($id);
        $activity->customer_book = request()->input('customer_book');
        $activity->remarks = request()->input('remarks');
        $activity->update();
        return back()->with('updateactivity', 'Activity Successfully Updated');
    }
    public function DestroyActivity($id)
    {
        $order = Order::find($id);
        $order->delete();
        return back()->with('deleted', 'Customer Activity Successfully Deleted!');
    }

    public function ConvertCustomer(request $request)
    {

      

        $activity = new Order;
        $activity->created_at = Carbon::now()->toDateTimeString();
        $activity->updated_at = Carbon::now()->toDateTimeString();
        $activity->customer_id = request()->input('customer_id');
        $activity->user_id = request()->input('user_id');
        $activity->sales_rep = request()->input('sales_rep');
        $activity->customer_book = request()->input('customer_book');
        $activity->remarks = "Won";
        $activity->Package_id = request()->input('Packages');
        $activity->save();

        $status = customer::find(request()->input('customer_id'));
        $status->customer_status = 'Won';
        $status->reason_hold = null;
        $status->last_activity = $activity['id'];
        $status->reason_lost = null;
        $status->reason_hold_date = null;
        $status->update();


        $is_won_exist = won_customer::where('customer_id', '=', $request->input('customer_id'))->first();
        $convert = [];
        if ($is_won_exist === null) {
            $convert = new won_customer;
            $convert->package_id = request()->input('Packages');
            $convert->customer_id = request()->input('customer_id');
            $convert->status = 'Won';
            $convert->save();
        }

        $book = [];
        $book = new Book;
        $book->book_title = request()->input('customer_book');
        $book->transaction_ID = request()->input('transaction_id');
        $book->won_id = request()->input('customer_id');
        $book->total_project_cost = request()->input('project_cost');
        $book->save();

        $chosen_num = 0;
        switch (request()->input('Packages')) {
            case 1:
                $chosen_num = 1;
                break;

            case 2:
                $chosen_num = 2;
                break;

            case 3:
                $chosen_num = 3;
                break;

            case 4:
                $chosen_num = 4;
                break;

            case 5:
                $chosen_num = 5;
                break;

            case 6:
                $chosen_num = 6;
                break;

            case 7:
                $chosen_num = 7;
                break;
            case 8:
                $chosen_num = 8;
                break;

            case 9:
                $chosen_num = 9;
                break;

            case 10:
                $chosen_num = 10;
                break;

            case 11:
                $chosen_num = 11;
                break;

            case 12:
                $chosen_num = 12;
                break;

            default:
                # code...
                break;
        }

        $this->createInclusions($this->inclusions_array, $book, $chosen_num, $request);
        return back();
    }


    private function createInclusions($arr_inclusions, $book, $parent_id, request $request)
    {
        if ($parent_id === 11) {
            $found = "";
            foreach ($arr_inclusions as $key => $inclusion) {
                if ($inclusion['parent'] === $parent_id  && $inclusion['service_name'] === request()->input('fixed_inclusion')) {
                    $found = $inclusion['task'];
                }
            }
            service_inclusion::insert([
                "project_cost" => request()->input('project_cost'),
                "book_id" => $book['id'],
                "package_id" => request()->input('Packages'),
                "won_id" =>  request()->input('customer_id'),
                "service_name" => request()->input('fixed_inclusion'),
                "task" =>  $found
            ]);
        } elseif ($parent_id === 12) {
            $found = "";
            foreach ($arr_inclusions as $key => $inclusion) {
                if ($inclusion['parent'] === $parent_id  && $inclusion['service_name'] === request()->input('fixed_editing')) {
                    $found = $inclusion['task'];
                }
            }
            service_inclusion::insert([
                "project_cost" => request()->input('project_cost'),
                "book_id" => $book['id'],
                "package_id" => request()->input('Packages'),
                "won_id" =>  request()->input('customer_id'),
                "service_name" => request()->input('fixed_editing'),
                "task" =>  $found
            ]);
        } else {
            foreach ($arr_inclusions as $key => $inclusion) {
                if ($inclusion['parent'] === $parent_id) {
                    if ($inclusion['calculate'] === 1) {
                        $inclusion['project_cost'] = $this->caculateInclusionCost($arr_inclusions, $request, $parent_id);
                    }
                    unset($inclusion['parent']);
                    unset($inclusion['calculate']);
                    $inclusion['won_id'] = request()->input('customer_id');
                    $inclusion['package_id'] = request()->input('Packages');
                    $inclusion['book_id'] = $book['id'];
                    service_inclusion::insert($inclusion);
                }
            }
        }
    }


    private function caculateInclusionCost($item, request $request, $parent_id)
    {
        $total = 0;
        $total_cost = request()->input('project_cost');
        foreach ($item as $key => $inclusion) {
            if ($inclusion['project_cost'] > 0  && $inclusion['parent'] === $parent_id) {
                $total_cost =  $total_cost -  $inclusion['project_cost'];
            }
        }

        return $total_cost;
    }
}

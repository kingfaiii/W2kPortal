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
            "service_name" => "sdsd",
            "project_cost" => 50,
            "task" => "FB Page Creation",
            "parent" => 2,
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

        $order = Order::all()
            ->where('customer_id', $id);

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

        $status = customer::find(request()->input('customer_id'));
        $status->customer_status = 'Won';
        $status->reason_hold = null;
        $status->reason_lost = null;
        $status->reason_hold_date = null;
        $status->update();

        $activity = new Order;
        $activity->created_at = Carbon::now()->toDateTimeString();
        $activity->updated_at = Carbon::now()->toDateTimeString();
        $activity->customer_id = request()->input('customer_id');
        $activity->user_id = request()->input('user_id');
        $activity->sales_rep = request()->input('sales_rep');
        $activity->customer_book = request()->input('customer_book');
        $activity->remarks = "Won";
        $activity->save();



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

        if (request()->input('Packages') == 1) {
            $this->createInclusions($this->inclusions_array, $book, 1, $request);
        } else if (request()->input('Packages') == 2) {
            $this->createInclusions($this->inclusions_array, $book, 2, $request);
        }

        return back();
    }


    private function createInclusions($arr_inclusions, $book, $parent_id, request $request)
    {
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

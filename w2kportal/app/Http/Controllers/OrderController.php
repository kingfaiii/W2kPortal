<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;

class OrderController extends Controller
{
    //
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


        //$save = $order->sales_rep;
        return view('order', ['order' => $order], ['customer' => $customer])->with("id", $id);
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
        $status->customer_status="Answered";
        $status->reason_hold=null;
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

    Public function ConvertCustomer(request $request)
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

        return back();
        
    }
}
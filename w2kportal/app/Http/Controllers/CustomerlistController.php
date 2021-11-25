<?php

namespace App\Http\Controllers;

use App\Models\book;
use App\Models\Customer;

use App\Models\customerlist;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerlistController extends Controller
{
    private $home;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::leftJoin('orders', 'customers.last_activity', '=', 'orders.id')
            ->select('customers.*', 'orders.remarks', 'orders.updated_at AS orderUpdated')
            ->get()->toArray();

        return view('list', ['home' => $customers]);
    }

    public function queryCustomerList(Request $request)
    {
        $query = $request->all();
        $customers = Customer::leftJoin('orders', 'customers.last_activity', '=', 'orders.id')
            ->select('customers.*', 'orders.remarks', 'orders.updated_at AS orderUpdated');

        if (!empty($query['date_from']) && !empty($query['date_to'])) {
            $query['date_from'] = date('Y-m-d 00:00:00', strtotime($query['date_from']));
            $query['date_to']   = date('Y-m-d 23:59:59', strtotime($query['date_to']));
        }

        $results = $customers->when(!empty($query['date_from']) && !empty($query['date_to']), function ($q) use ($query) {
            return $q->whereBetween('customers.created_at', [$query['date_from'] . '%', $query['date_to'] . '%']);
        })->when(!empty($query['search_value']), function ($q) use ($query) {
            return $q->where(function ($q) use ($query) {
                $q->where('customers.customer_fname', 'LIKE', '%' . trim($query['search_value']) . '%')
                    ->orwhere('customers.customer_lname', 'LIKE', '%' . trim($query['search_value']) . '%')
                    ->orWhere('customers.customer_email', 'LIKE', '%' . trim($query['search_value']) . '%')
                    ->orwhere('customers.customer_status', 'LIKE', '%' . trim($query['search_value']) . '%')
                    ->orWhere('orders.remarks', 'LIKE', '%' . trim($query['search_value']) . '%');
            });
        })->when(!empty($query['order_by']), function ($q) use ($query) {
            return $q->orderBy('customers.' . $query['order_by'], 'DESC');
        });

        return response()->json($results->get(), 200);
    }

    public function Destroy($id)
    {
        $customer = Customer::Find($id);
        $customer->delete();
        return back();
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //
        $home = User::all();

        return view('report', ['home' => $home]);
    }

    public function indexReportList($id, Request $request)
    {
        $query = $request->all();

        if (!empty($query['date_from']) && !empty($query['date_to'])) {
            $query['date_from'] = date('Y-m-d 00:00:00', strtotime($query['date_from']));
            $query['date_to']   = date('Y-m-d 23:59:59', strtotime($query['date_to']));
        }


        $home = User::Find($id)
            ->join('orders', 'users.id', '=', 'orders.user_id')
            ->join('customers', 'orders.customer_id', '=', 'customers.id')
            ->select('customers.customer_fname', 'customers.customer_lname', 'customers.customer_email', 'orders.remarks', 'orders.created_at')
            ->where('orders.user_id','=',$id)
            ->when(!empty($query['date_from']) && !empty($query['date_to']), 
            function ($q) use ($query) {
                return $q->whereBetween('orders.created_at', [$query['date_from'] . '%', $query['date_to'] . '%']);
            });


        $user = User::all()
            ->where('id', $id);

        if (array_key_exists('act', $query) && $query['act'] === 'api') {
            return response()->json(["table_data" => $home->get(), "current_count" => $home->get()->count()], 200);
        } else {
            return view('reportList', ['home' => $home->get(), 'user' => $user, 'count' => $home->get()->count()]);
        }
    }

}

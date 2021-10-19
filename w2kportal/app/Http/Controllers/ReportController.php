<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
        
    }
    public function index()
    {
        //
        $home = User::all();
        
        return view('report',['home'=>$home]);
    }
    public function indexReportList($id)
    {
        $home = User::Find($id)
        ->join('Orders','users.id','=','orders.user_id')
        ->join('customers','orders.customer_id','=','customers.id')
        ->select('users.*','customers.customer_fname','customers.customer_lname','customers.customer_email','orders.remarks')
        ->get();
        
        $count = User::Find($id)
        ->join('Orders','users.id','=','orders.user_id')
        ->join('customers','orders.customer_id','=','customers.id')
        ->select('users.*','customers.customer_fname','customers.customer_lname','orders.remarks','orders.created_at')
        ->count();
        
        $user = User::all()
        ->where('id',$id);
 
        return view('reportList',['home'=>$home],['user'=>$user],['count'=>$count]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report)
    {
        //
    }
}

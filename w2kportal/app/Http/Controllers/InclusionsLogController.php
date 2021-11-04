<?php

namespace App\Http\Controllers;

use App\Models\inclusions_log;
use Illuminate\Http\Request;

class InclusionsLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
        $history = inclusions_log::join('service_inclusions', 'inclusions_logs.log_id', '=', 'service_inclusions.id')
            ->join('users', 'inclusions_logs.user_id', '=', 'users.id')
            ->where('inclusions_logs.book_id', '=', $id);


        return view('InclusionHistory', ['history' => $history->get()]);
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
     * @param  \App\Models\inclusions_log  $inclusions_log
     * @return \Illuminate\Http\Response
     */
    public function show(inclusions_log $inclusions_log)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\inclusions_log  $inclusions_log
     * @return \Illuminate\Http\Response
     */
    public function edit(inclusions_log $inclusions_log)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\inclusions_log  $inclusions_log
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, inclusions_log $inclusions_log)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\inclusions_log  $inclusions_log
     * @return \Illuminate\Http\Response
     */
    public function destroy(inclusions_log $inclusions_log)
    {
        //
    }
}

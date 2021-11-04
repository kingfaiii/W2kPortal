<?php

namespace App\Http\Controllers;

use App\Models\inclusions_log;
use App\Models\User;
use Illuminate\Http\Request;

class InclusionsLogController extends Controller
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


    public function index($id)
    {
        //


        $history = inclusions_log::join('service_inclusions', 'service_inclusions.id', '=', 'inclusions_logs.log_id')
            ->join('users', 'inclusions_logs.user_id', '=', 'users.id')
            ->where('inclusions_logs.book_id', '=', $id)
            ->select('inclusions_logs.*', 'service_inclusions.service_name AS serName')
            ->orderBy('inclusions_logs.id', 'DESC');

        $history_info = [];
        foreach ($history->get()->toArray() as $key => $histories) {

            foreach ($histories as $history_key => $histor) {
                $hasAsterisk = explode('*',  $histor);

                $history_info[$key][$history_key . '_by'] = isset($hasAsterisk[1]) ? $this->get_user_details($hasAsterisk[1]) : null;
                $history_info[$key][$history_key] = $histor;
            }
        }

        return view('InclusionHistory', ['history' =>  $history_info]);
    }

    private function get_user_details($id)
    {
        $user = User::where('id', $id)->get();

        $credentials = $user->toArray()[0];

        return !empty($credentials) ? $credentials['name'] : '';
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

<?php

namespace App\Http\Controllers;

use App\Models\QualityAssurance;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class QualityAssuranceController extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (session('success')) {
                Alert::success(session('success'));
            }

            if (session('error')) {
                Alert::error(session('error'));
            }

            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $qa = QualityAssurance::all();
        return view('qa', ['qa' => $qa]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(request $request)
    {
        //
        $users = QualityAssurance::where('qa_email', '=', $request->input('qa_email'))->first();
        if ($users === null) {
            // User does not exist
            QualityAssurance::create($request->all());

            return back()->with('success', 'Quality Assurance added successfully.');
        } else {
            // alert()->error('Sweet Alert with error.');
            return back()->with('error', 'This Quality Assurance is already on the list.');
        }
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
     * @param  \App\Models\owner  $owner
     * @return \Illuminate\Http\Response
     */
    public function show(QualityAssurance $qa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\owner  $owner
     * @return \Illuminate\Http\Response
     */
    public function edit(QualityAssurance $qa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\owner  $owner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, QualityAssurance $qa, $id)
    {
        //
        $qaData = QualityAssurance::find($id);
        $qaData->qa_fname = request()->input('qa_fname');
        $qaData->qa_lname = request()->input('qa_lname');
        $qaData->qa_email = request()->input('qa_email');
        $qaData->update();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\owner  $owner
     * @return \Illuminate\Http\Response
     */
    public function destroy(QualityAssurance $qa)
    {
        //
    }
}

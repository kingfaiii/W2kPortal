<?php

namespace App\Http\Controllers;

use App\Models\owner;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class OwnerController extends Controller
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
        $owner = Owner::all();
        return view('owner', ['owner' => $owner]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(request $request)
    {
        //
        $users = owner::where('owner_email', '=', request('owner_email'))->first();
        if ($users === null) {
            // User does not exist
            owner::create($request->all());

            return back()->with('success', 'Owner added successfully.');
        } else {
            // alert()->error('Sweet Alert with error.');
            return back()->with('error', 'This Owner is already on the list.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\owner  $owner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, owner $owner, $id)
    {
        //
        $ownerData = Owner::find($id);
        $ownerData->owner_fname = request('owner_fname');
        $ownerData->owner_lname = request('owner_lname');
        $ownerData->owner_email = request('owner_email');
        $ownerData->update();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\owner  $owner
     * @return \Illuminate\Http\Response
     */
    public function destroy(owner $owner, $id)
    {
        //
        $order = Owner::find($id);
        $order->delete();
        return back();
    }
}

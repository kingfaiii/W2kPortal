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

        // User does not exist
        $owner = new owner;
        $owner->owner_fname = ucwords(strtolower(request('owner_fname')));
        $owner->owner_fname = ucwords(strtolower(request('owner_lname')));
        $owner->owner_fname = request('owner_role');
        $owner->save();
        return back()->with('success', 'Owner added successfully.');
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
        $ownerData->owner_fname = ucwords(strtolower(request('owner_fname')));
        $ownerData->owner_lname = ucwords(strtolower(request('owner_lname')));
        $ownerData->role = request('owner_role');
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

<?php

namespace App\Http\Controllers;

use App\Models\customer;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $home = customer::all();

        return view('home', ['home' => $home]);
    }

    public function Store(request $request)
    {
        $request->validate([
            'customer_email' => 'required',
            'customer_fname' => 'required',
            'customer_lname' => 'required',
            'customer_status' => 'required',
        ]);
        $users = customer::where(
            'customer_email',
            '=',
            $request->input('customer_email')
        )->first();
        if ($users === null) {
            // User does not exist
            $firstName = ucwords(strtolower(request('customer_fname')));
            $lastName = ucwords(strtolower(request('customer_lname')));
            $dataid = new customer;
            $dataid->customer_fname = $firstName;
            $dataid->customer_lname = $lastName;
            $dataid->customer_email = strtolower(request('customer_email'));
            $dataid->customer_status = 'Answered';
            $dataid->save();
            $id = $dataid->id;
            return redirect()
                ->route('order', [$id])
                ->with('success', 'Customer added successfully.');
        } else {
            // alert()->error('Sweet Alert with error.');
            return redirect()
                ->route('home')
                ->with('error', 'This Customer is already on the list.');
        }
    }
    public function Destroy($id)
    {
        $customer = customer::Find($id);
        $customer->delete();
        return back();
    }
}

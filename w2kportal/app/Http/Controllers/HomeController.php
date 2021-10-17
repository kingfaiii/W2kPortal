<?php

namespace App\Http\Controllers;
use App\Models\Customer;
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
        $this->middleware('auth');
        $this->middleware(function($request,$next){
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

        $home = Customer::all();
        
        return view('home',['home'=>$home]);
        
    }

    public function Store(request $request){
        $request->validate([
            'customer_email' => 'required',
            'customer_fname' => 'required',
            'customer_lname' => 'required',
            'customer_status' => 'required',
        ]);
        $users = Customer::where('customer_email', '=', $request->input('customer_email'))->first();
        if ($users === null) {
          // User does not exist
          $dataid = Customer::create($request->all());
         $id = $dataid->id;
          return redirect()->route('order',[$id])->with('success','Customer added successfully.');
  
        }else{
          // alert()->error('Sweet Alert with error.');
          return redirect()->route('home')->with('error','This Customer is already on the list.');

        }
    }
    public function Destroy($id){
        $customer = Customer::Find($id);
        $customer->delete();
        return back();
    }
}

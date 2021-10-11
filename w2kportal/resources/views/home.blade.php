@extends('layouts.app')

@section('content')
@include('sweetalert::alert')
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-5">
                    <div class="content">
                        <a type="button" href="#" class="" data-toggle="modal" data-target="#exampleModalCenter">
                       
                            <div class="content-overlay"></div>
                            <img src="./images/button_add.png" alt="Add Customer" class="content-image">
                            {{-- <div class="content-details">
                                <h3 class="content-title">Add Customer</h3>
                            </div> --}}
                    
                        </a>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="content">
                        <a href="{{ route('list') }}">
                            <div class="content-overlay"></div>
                            <img src="./images/button_search.png" alt="Search Customer" class="content-image">
                            {{-- <div class="content-details">
                                <h3 class="content-title">Search/Update Customer</h3>
                            </div> --}}
                        </a>
                    </div>
                </div>
                <div class="col-md-1"></div>
            </div>
        </div>
        <form action="{{ route('home.store') }}" Method="POST">
            @csrf
           <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
               <div class="modal-dialog modal-dialog-centered" role="document">
                 <div class="modal-content">
                   <div class="modal-header bg-secondary text-center">
                     <h5 class="modal-title text-white" id="exampleModalLongTitle">Add Customer</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span class="text-white" aria-hidden="true">&times;</span>
                     </button>
                   </div>
                   <div class="modal-body py-4">
                       <input type="text" placeholder="Customer First Name" name="customer_fname" value="" id="" class="form-control">
                       <input type="text" placeholder="Customer Last Name" name="customer_lname" value="" id="" class="form-control">
                       <input type="text" placeholder="Customer Email" name="customer_email" value="" id="" class="form-control">
                       <input type="text" hidden name="customer_status" value="Answered" id="" class="form-control">
                    </div>
                   <div class="modal-footer bg-secondary">
                     <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                     <input type="submit" value="Add Customer" name="addcustomerbtn" class="btn btn-success">
                   </div>
                 </div>
               </div>
             </div> 
             @include('sweet::alert')   
        </form>   
@endsection

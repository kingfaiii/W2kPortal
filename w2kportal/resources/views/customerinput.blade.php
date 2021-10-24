@extends('layouts.app')


@section('content')
<main>
    <div>
        <div class="container-fluid mt-3">
           <div class="row">
               <div class="col-md-12">
                   <div class="card mt-5">
                    <div class="card-header">
                        <h2 class="text-dark">Convert Customer Details</h2>
                    </div>
                    <div class="card-body">
                        <div class="row pl-5">
                            @foreach ($information as $item)
                            
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <p class="text-dark col-sm-2">Customer Name:</p>
                                    <div class="col-sm-6">
                                      {{-- <p>Dito I output yung Name ng customer</p> --}}
                                  
                                     {{$item->customer_fname}} {{$item->customer_lname}}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <p class="text-dark col-sm-2">Email Address:</p>
                                    <div class="col-sm-6">
                                      {{-- <p>Dito I output yung Email ng customer</p> --}}
                                      {{$item->customer_email}}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <p class="text-dark col-sm-2">Date Inquire:</p>
                                    <div class="col-sm-6">
                                        {{$item->customer_createdAt}}
                                      {{-- <p>Dito I output yung date ng customer kung kelan siya na create</p> --}}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <p class="text-dark col-sm-2">Payment Date:</p>
                                    <div class="col-sm-6">
                                        {{$item->won_createdAt}}
                                      {{-- <p>Dito I output yung date ng customer kung kelan siya naging won</p> --}}
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <p class="text-dark col-sm-2">Transaction ID:</p>
                                    <div class="col-sm-6">
                                        {{$item->transaction_ID}}
                                      {{-- <p>Dito I output yung Transacion ID ng customer</p> --}}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <p class="text-dark col-sm-2">Book Title:</p>
                                    <div class="col-sm-6">
                                        {{$item->book_title}}
                                      {{-- <p>Dito I output yung title ng book ng customer na na won</p> --}}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <p class="text-dark col-sm-2">Service:</p>
                                    <div class="col-sm-6">
                                        {{$item->package_name}}
                                      {{-- <p>Dito I output yung service ng customer na na won</p> --}}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <p class="text-dark col-sm-2">Total Project Cost:</p>
                                    <div class="col-sm-6">
                                      {{-- <p>Dito I output yung Total Project Cost ng customer na na won</p> --}}
                                    </div>
                                </div>
                            </div>
                            @endforeach      
                           
                        </div>
                       
                        <div class="table-wrapper-scroll-x my-custom-scrollbar">
                            <table style="width:300px;overflow-x:auto;" class="table table-stripped">
                                <thead>
                                    <tr class="text-center">
                                        <th>Service Inclusions</th>
                                        <th>Project Cost</th>
                                        <th>Layout</th>
                                        <th>Page/Word Count</th>
                                        <th>Project Classification</th>
                                        <th>Turnaround Time</th>
                                        <th>Status</th>
                                        <th>Task</th>
                                        <th>Commitment Date</th>
                                        <th>Owner</th>
                                        <th>Job Cost</th>
                                        <th>Date Assigned</th>
                                        <th>Date Completed</th>
                                        <th>QA</th>
                                        <th>QA Score</th>
                                        <th>UID</th>
                                        <th>Project Link</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="text-center">
                                        <td>Noob</td>
                                        <td>Noob</td>
                                        <td>Noob</td>
                                        <td>Noob</td>
                                        <td>Noob</td>
                                        <td>Noob</td>
                                        <td>Noob</td>
                                        <td>Noob</td>
                                        <td>Noob</td>
                                        <td>Noob</td>
                                        <td>Noob</td>
                                        <td>Noob</td>
                                        <td>Noob</td>
                                        <td>Noob</td>
                                        <td>Noob</td>
                                        <td>Noob</td>
                                        <td>Noob</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                   </div>
               </div>
           </div>
        </div>
    </div>
</main>
@endsection
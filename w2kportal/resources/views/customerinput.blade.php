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
                            @foreach ($customer_information as $item)
                            
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
                       
                        <div style="width:100%;overflow-x:auto;" class="table-wrapper-scroll-x my-custom-scrollbar">
                            <table class="table table-stripped">
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
                                   
                                       @foreach ($book_information as $item)
                                       <tr class="text-center">
                                           <td>  {{ $item->service_name}} </td>
                                           <td>  {{ $item->project_cost}} </td>
                                           <td>  {{ $item->layout}} </td>
                                           <td>  {{ $item->page_count}} </td>
                                           <td>  {{ $item->project_classification}} </td>
                                           <td>  {{ $item->turnaround_time}} </td>
                                           <td>  {{ $item->status}} </td>
                                           <td>  {{ $item->task}} </td>
                                           <td>  {{ $item->commitment_date}} </td>
                                           <td>  {{ $item->owner}} </td>
                                           <td>  {{ $item->job_cost}} </td>
                                           <td>  {{ $item->date_assigned}} </td>
                                           <td>  {{ $item->date_completed}} </td>
                                           <td>  {{ $item->quality_assurance}} </td>
                                           <td>  {{ $item->quality_score}} </td>
                                           <td>  {{ $item->uid}} </td>
                                           <td>  {{ $item->project_link}} </td>
                                       </tr>
                                       @endforeach
                                   
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
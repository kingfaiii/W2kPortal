@extends('layouts.app')


@section('content')
<main>
    <div>
        <form action="" method="POST">
            @csrf
        
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
                       
                        <div style="width:100%;" class="table-wrapper-scroll-x my-custom-scrollbar">
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
                                      
                                    </tr>
                                </thead>
                                <tbody>
                                   
                                       @foreach ($book_information as $item)
                                       <tr data-id="{{$item->id}}" class="text-center">
                                           <td>  {{ $item->service_name}} </td>
                                           <td>  {{ $item->project_cost}} </td>
                                           <td>
                                               <select class="form-control" name="Layout" id="">
                                                   <option selected value="{{ $item->layout}} ">{{ $item->layout}} </option>
                                                    <option value="">Data</option>
                                                </select>
                                           </td>
                                           <td>  <input type="text" value="{{ $item->page_count}}" class="form-control" name="page_count" id=""> </td>
                                           <td> 
                                                <select class="form-control" name="Layout" id="">
                                                    <option selected value=" {{ $item->project_classification}}"> {{ $item->project_classification}} </option>
                                                    <option value="">Data</option>
                                                </select>
                                          </td>
                                           <td> <input type="text" name="turnaround_time" value="{{ $item->turnaround_time}}" id="" class="form-control">   </td>
                                           <td>  
                                            <select class="form-control" name="Layout" id="">
                                                <option selected value="  {{ $item->status}}">  {{ $item->status}} </option>
                                                <option value="Completed">Completed</option>
                                                <option value="On-going">On-going</option>
                                                <option value="On Hold">On Hold</option>
                                            </select>
                                              
                                          </td>
                                           <td>  {{ $item->task}} </td>
                                           <td> <input type="date" name="commitment_date" value="{{ $item->commitment_date}} " id="" class="form-control"> </td>
                                         
                                       </tr>
                                       @endforeach
                                   
                                </tbody>
                            </table>
                            <table class="table table-stripped">
                                <thead>
                                    <tr class="text-center">
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
                                       <tr data-id="{{$item->id}}" class="text-center">
                                            <td> 
                                                <select name="owner" id="" class="form-control">
                                                    <option value="{{ $item->owner}} ">{{ $item->owner}} </option>
                                                    <option value="data ">data </option>
                                                </select> 
                                            </td>
                                           <td> <input type="text" name="job_cost" value="{{ $item->job_cost}} " id="" class="form-control"> </td>
                                           <td> <input type="date" name="date_assigned" valuie="{{ $item->date_assigned}}" id="" class="form-control">   </td>
                                           <td> <input type="date" name="date_completed" valuie="  {{ $item->date_completed}}" id="" class="form-control">   </td>
                                           <td>
                                               <select name="qa" id="" class="form-control">
                                                   <option selected value=" {{ $item->quality_assurance}} "> {{ $item->quality_assurance}} </option>
                                                   <option value=" {{ $item->quality_assurance}} ">data </option>
                                               </select> 
                                            </td>
                                           <td> <input type="text" name="quality_score" value="{{ $item->quality_score}} " id="" class="form-control"></td>
                                           <td> <input type="text" name="uid" value="{{ $item->uid}}" id="" class="form-control"></td>
                                           <td> <input type="text" name="project_link" value="{{ $item->project_link}} " id="" class="form-control"> </td>
                                       </tr>
                                       @endforeach
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="submit" class="btn btn-success col-12" value="Update">
                            </div>
                            <div class="col-md-6">
                                <input type="submit" class="btn btn-danger col-12" value="Cancel">
                            </div>
                        </div>
                    </div>
                   </div>
               </div>
           </div>
        </div>
    </form>
    </div>
</main>
@endsection
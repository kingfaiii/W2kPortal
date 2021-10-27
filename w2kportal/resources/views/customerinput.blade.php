@extends('layouts.app')


@section('content')
<main>
    <div>
        <form id="customerinput_form" action="{{ route('UpdateInclusions') }}" method="POST">
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
                                        ${{ $item->cost }}
                                      {{-- <p>Dito I output yung Total Project Cost ng customer na na won</p> --}}
                                    </div>
                                </div>
                            </div>
                            @endforeach      
                           
                        </div>
                       
                        <div style="width:100%;" class="table-wrapper-scroll-x my-custom-scrollbar">
                            <table class="table table-stripped">
                                <thead class="text-center">
                                        <th>Service Inclusions</th>
                                        <th>Project Cost</th>
                                        <th>Layout</th>
                                        <th>Page/Word Count</th>
                                        <th>Project Classification</th>
                                        <th>Turnaround Time</th>
                                        <th>Status</th>
                                        <th>Task</th>
                                        <th>Commitment Date</th>
                                      
                                </thead>
                                <tbody>
                                   
                                       @foreach ($book_information as $item)
                                       <tr data-id="{{$item->id}}" class="text-center align-center justify-content-center">
                                           <td>  {{ $item->service_name}} </td>
                                           <td>  {{ $item->project_cost}} </td>
                                           <td>
                                               <select class="form-control" style="width:115%" name="item[{{$item->serID}}][layout]" id="">
                                                   <option selected value="{{ $item->layout}} ">{{ $item->layout}} </option>
                                                    <option value="Reflowable">Reflowable</option>
                                                    <option value="Fixed Virtual">Fixed Virtual</option>
                                                    <option value="ixed Hidden">Fixed Hidden</option>
                                                    <option value="Combination">Combination</option>
                                                </select>
                                           </td>
                                           <td>  <input type="text" value="{{ $item->page_count}}" style="margin-left:25%" class="form-control justify-content-center col-6" name="item[{{$item->serID}}][page_count]" id=""> </td>
                                           <td> 
                                                <select class="form-control" name="item[{{$item->serID}}][project_classification]" id="">
                                                    <option selected value=" {{ $item->project_classification}}"> {{ $item->project_classification}} </option>
                                                    <option value="Simple">Simple</option>
                                                    <option value="Moderate">Moderate</option>
                                                    <option value="Complex">Complex</option>
                                                    <option value="Difficult">Difficult</option>
                                                </select>
                                          </td>
                                           <td> <input type="text" name="item[{{$item->serID}}][turnaround_time]" value="{{ $item->turnaround_time}}" id="" style="margin-left:25%" class="form-control col-6">   </td>
                                           <td>  
                                            <select class="form-control" style="width:136%;margin-left:-28%;" name="item[{{$item->serID}}][status]" id="">
                                                <option selected value="  {{ $item->status}}">  {{ $item->status}} </option>
                                                <option value="Completed">Completed</option>
                                                <option value="On-going">On-going</option>
                                                <option value="On Hold">On Hold</option>
                                            </select>
                                              
                                          </td>
                                           <td>  {{ $item->task}} </td>
                                           <td> <input type="date" name="item[{{$item->serID}}][commitment_date]" value="{{ $item->commitment_date}}" style="margin-left:5%" id="" class="form-control col-11"> </td>
                                       </tr>
                                       @endforeach
                                   
                                </tbody>
                            </table>
                            <table class="table table-stripped">
                                <thead class="text-center">
                                        <th>Service Inclusions</th>
                                        <th>Owner</th>
                                        <th>Job Cost</th>
                                        <th>Date Assigned</th>
                                        <th>Date Completed</th>
                                        <th>QA</th>
                                        <th>QA Score</th>
                                        <th>UID</th>
                                        <th>Project Link</th>
                                </thead>
                                <tbody>
                                   
                                       @foreach ($book_information as $item)
                                       <tr data-id="{{$item->id}}" class="text-center">
                                        <td>  {{ $item->service_name}} </td>    
                                            <td> 
                                                <select name="item[{{$item->serID}}][owner]" id="" style="width:190%;margin-left:-20%" class="form-control">
                                                    <option value="{{ $item->owner}} ">{{ $item->owner}} </option>
                                                    <option value="data ">data</option>
                                                </select> 
                                            </td>
                                           <td> <input type="text" name="item[{{$item->serID}}][job_cost]" style="margin-left:40%" value="{{ $item->job_cost}} " id="" class="form-control col-8"> </td>
                                           <td> <input type="date" name="item[{{$item->serID}}][date_assigned]" value="{{ $item->date_assigned}}" style="margin-left:-5%" id="" class="form-control col-11">   </td>
                                           <td> <input type="date" name="item[{{$item->serID}}][date_completed]" value="{{ $item->date_completed}}" style="margin-left:-5%" id="" class="form-control col-11">   </td>
                                           <td>
                                               <select name="item[{{$item->serID}}][quality_assurance]" id="" style="margin-left:-30%;width:180%" class="form-control">
                                                   <option selected value=" {{ $item->quality_assurance}} "> {{ $item->quality_assurance}} </option>
                                                   <option value="King Fai">KingFai</option>
                                               </select> 
                                            </td>
                                           <td> <input type="text" name="item[{{$item->serID}}][quality_score]" value="{{ $item->quality_score}} " style="margin-left:25px;width:50%"id="" class="form-control"></td>
                                           <td> <input type="text" name="item[{{$item->serID}}][uid]" value="{{ $item->uid}}" id="" class="form-control"></td>
                                           <td> <input type="text" name="item[{{$item->serID}}][project_link]" value="{{ $item->project_link}} " id="" class="form-control"> </td>
                                       </tr>
                                       @endforeach
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="submit" id="customerinput_update" class="btn btn-success col-12" value="Update">
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


<script>
  $(document).ready(function () {

        $('#customerinput_update').on('click', function(e) {
            e.preventDefault()
        
           let formInputs = $('#customerinput_form').serializeArray()

            let result =  {items:[]};
            formInputs.forEach(function(input){
                nameArray = input.name.split(/[[\]]/);
                item = nameArray[1];
                prop = nameArray[3];
                if(typeof result.items[item] !== 'object'){
                    result.items[item]={};
                }
                
                if(typeof result.items[item][prop] !== 'undefined'){
                //Consistency check the name attribute
                    console.log('Warning duplicate "name" property =' + input.name);
                }
                
                if(prop) {
                    result.items[item][prop]=input.value;
                }
            });

            // $('#customerinput_form').find('table tbody tr').each(function() {
            //     let service_id = $(this).data('id');
            
            // })

                
            result.items.map((k, i) => {
                   if(i > 0) {
                    k['service_id'] = i
                   }
            })
            console.log(result.items)
            $.post('/update/service/inclusions', {item: result.items,  _token: "{{ csrf_token() }}"},function(response) {
                        // Log the response to the console
                console.log("Response: "+response);
            });
        })  

     
    });
</script>
@endsection
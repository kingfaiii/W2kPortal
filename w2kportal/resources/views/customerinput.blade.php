@extends('layouts.table')
@extends('layouts.app')


@section('content')

    @section('header')
    <form id="customerinput_form" action="{{ route('UpdateInclusions') }}" method="POST">
        @csrf
        <div class="col-md-12">
            <h2 class="text-white font-weight-bold">Convert Customer Details</h2>
        </div>
    @endsection

 @section('otherforms')
 @foreach ($customer_information as $item)
 <div class="row mt-3 ml-2">
     <div class="col-md-5">
         <div class="form-group row">
             <p class="text-white h5">Customer Name:</p>
             <div class="col-sm-6">
                <h5 class="text-white">{{$item->customer_fname}} {{$item->customer_lname}}</h5> 
             </div>
         </div>
     </div>
     <div class="col-md-5">
        <div class="form-group row">
            <p class="text-white h5">Book Title:</p>
            <div class="col-sm-6">
               <h5 class="text-white">{{$item->book_title}}</h5> 
            </div>
        </div>
     </div>
 </div>
 <div class="row ml-2">
    <div class="col-md-5">
       <div class="form-group row">
           <p class="text-white h5">Email Address:</p>
           <div class="col-sm-6">
              <h5 class="text-white">{{$item->customer_email}}</h5> 
           </div>
       </div>
    </div>
    <div class="col-md-5">
       <div class="form-group row">
           <p class="text-white h5">Service:</p>
           <div class="col-sm-6">
              <h5 class="text-white">{{$item->package_name}}</h5> 
           </div>
       </div>
    </div>
</div>
 <div class="row ml-2">
     <div class="col-md-5">
        <div class="form-group row">
            <p class="text-white h5">Date Inquire:</p>
            <div class="col-sm-6">
               <h5 class="text-white">{{$item->customer_createdAt}}</h5> 
            </div>
        </div>
     </div>
     <div class="col-md-5">
        <div class="form-group row">
            <p class="text-white h5">Payment Date:</p>
            <div class="col-sm-6">
               <h5 class="text-white">{{$item->won_createdAt}}</h5> 
            </div>
        </div>
     </div>
 </div>
 <div class="row ml-2">
    <div class="col-md-5">
       <div class="form-group row">
        <p class="text-white h5">Total Project Cost:</p>
           <div class="col-sm-6">
            <h5 class="text-white">${{$item->cost}}</h5> 
         </div>
         
       </div>
    </div>
    <div class="col-md-5">
       <div class="form-group row">
        <p class="text-white h5">Transaction ID:</p>
           <div class="col-sm-6">
            <h5 class="text-white">{{$item->transaction_ID}}</h5> 
         </div>
       </div>
    </div>
</div>
 @endforeach
 @endsection
    @section('table')
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
                       <td> ${{ $item->project_cost}} </td>
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
                                <option value="{{ $item->owner}}">{{ $item->owner}}</option>
                                @foreach ($owner as $owner_row)
                                <option value="{{ $owner_row->owner_fname}} {{ $owner_row->owner_lname }}">{{ $owner_row->owner_fname}} {{ $owner_row->owner_lname}}</option>
                                @endforeach
                            </select> 

                        </td>
                       <td> <input type="text" name="item[{{$item->serID}}][job_cost]" style="margin-left:40%" value="{{ $item->job_cost}} " id="" class="form-control col-8"> </td>
                       <td> <input type="date" name="item[{{$item->serID}}][date_assigned]" value="{{ $item->date_assigned}}" style="margin-left:-5%" id="" class="form-control col-11">   </td>
                       <td> <input type="date" name="item[{{$item->serID}}][date_completed]" value="{{ $item->date_completed}}" style="margin-left:-5%" id="" class="form-control col-11">   </td>
                       <td>
                           <select name="item[{{$item->serID}}][quality_assurance]" id="" style="margin-left:-30%;width:180%" class="form-control">
                               <option selected value=" {{ $item->quality_assurance}} "> {{ $item->quality_assurance}} </option>
                               @foreach ($qa as $qa_row)
                               <option value="{{ $qa_row->qa_fname }} {{ $qa_row->qa_lname }}">{{ $qa_row->qa_fname }} {{ $qa_row->qa_lname }}</option>
                               @endforeach
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
    @endsection
    @section('footer')
    <div class="card-footer bg-secondary">
        <div class="row">
            <div class="col-md-6">
                <input type="submit" id="customerinput_update" class="btn btn-success col-12" value="Update">
            </div>
            <div class="col-md-6">
                <input type="submit" class="btn btn-danger col-12" value="Cancel">
            </div>
        </div>
    </div>
</form>
    @endsection

<script>
  $(document).ready(function () {

        const messagePrompt = async (title="", text="", showCancel=false, icon="info", textConfirm) => {
            return  await Swal.fire({
                            title: title,
                            text: text,
                            icon: icon,
                            showCancelButton: showCancel,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: textConfirm
            })

        } 

        $('#customerinput_update').on('click', async function(e) {
            e.preventDefault()
            let formInputs = $('#customerinput_form').serializeArray()
            let result =  {items:[]};
            const msgResult = await  messagePrompt("Are you sure?",'This Service Inclusion will be Updated', true, 'warning', "Yes Update it!!")

            if(msgResult.isConfirmed) {
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
    
                result.items.map((k, i) => {
                    if(i > 0) {
                        k['service_id'] = i
                    }
                })

                $.ajax({
                    type: 'POST',
                    url: '/update/service/inclusions',
                    data: {item: result.items,  _token: "{{ csrf_token() }}"},
                    success: function(data) {
                        if(data===200) messagePrompt('Successfully Updated', "", false, "success", "Got it")
                    },
                    error: function(xhr) { // if error occured
                        messagePrompt('Error occured.please try again', "", false, "danger", "Ok")
                    },
                });
                                
            }
        
        
        })  
     
    });
</script>
@endsection
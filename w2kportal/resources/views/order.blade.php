@extends('layouts.app')

@section('content')
@include('sweetalert::alert')

@foreach ($customer as $customers)
<form action="{{ route('UpdateOrder',$customers->id) }}" method="POST">
  @csrf
  <input type="text" name="updatestatuscustomerid" id="" value="{{ $customers->id }}" hidden>
  <input type="text" name="updatestatususerid" id="" value="{{ Auth::user()->id; }}" hidden>
  <input type="text" name="updatestatususername" id="" value="{{ Auth::user()->name; }}" hidden>

  <div class="container-fluid" id="main_container">
    <div class="row">
      <div class="col-md-1">
      </div>
      <div class="col-md-10 bg-light mt-5">
        <div class="card bg-light">
          <div class="card-header">
            <h1 class="text-dark font-weight-bolder">Customer Information</h1>
          </div>
          <div class="card-body">
            <div class="form-group row">
              <p class="text-dark col-sm-2">Customer ID:</p>
              <div class="col-sm-6">
                <p>W2k-{{ $customers->id }}</p>
              </div>
            </div>
            <div class="form-group row">
              <p for="staticEmail" class=" text-dark col-sm-2">Customer Name: </p>
              <div class="col-sm-6">
                <p class="">{{ $customers->customer_fname }} {{ $customers->customer_lname }}</p>
              </div>
            </div>
            <div class="form-group row">
              <p for="emailaddress" class="text-dark col-md-2">Email Address:</p>
              <div class="col-md-6">
                <p>{{ $customers->customer_email }}</p>
              </div>
            </div>
            <div class="form-group row">
              <label for="status" class="text-dark col-md-2">Status:</label>
              <div class="col-md-6">
                <select onchange="show(this)" name="customer_status" id="customer_status_test" class="form-control" value="{{ $customers->customer_status }}">
                  <option selected value="{{$customers->customer_status}}">{{$customers->customer_status}}</option>
                  <option value="Answered">Answered</option>
                  <option value="Hold">Hold</option>
                  <option value="Lost">Lost</option>
                </select>
              </div>
            </div>

            <div class="form-group row" id="reason_container">


              <label id="reasonlabel" for="Reason" class="text-dark col-md-2">Reason:</label>
              <div id="ReasonLost" class="col-md-6">
                <select class="form-control" name="Reasonlost" id="">
                  @if ($customers->reason_lost=="")
                  <option value="">--Please Select--</option>
                  @else
                  <option value="{{ $customers->reason_lost }}">{{ $customers->reason_lost }}</option>
                  @endif
                  <option value="Stopped Replying">Stopped Replying</option>
                  <option value="Can't Afford/Price Issues">Can't Afford/Price Issues</option>
                  <option value="Found Another Company">Found Another Company</option>
                  <option value="Change of Mind">Change of Mind</option>
                  <option value="Personally formatted/book is formatted">Personally formatted/book is formatted</option>
                  <option value="Trying to contact publisher">Trying to contact publisher</option>
                  <option value="W2K Contact Issues">Website price or other issues</option>
                  <option value="Email bounce">Email bounce</option>
                  <option value="Still working on the project">Still working on the project</option>
                </select>
              </div>
              <div id="reasonhold" class="col-md-6">
                <input type="date" class="form-control" value="{{ $customers->reason_hold_date }}" name="reason_hold_date" id="">
                <input name="reason_hold"  placeholder="Reason for Holding Customer" id="" class="form-control" value="{{ $customers->reason_hold }}">
              </div>
            </div>
            @endforeach
            <table class="table table-stripped">
              <thead>
                <tr class="text-center">
                  <th>Date & Time</th>
                  <th>User ID</th>
                  <th>Sales Rep</th>
                  <th>Remarks</th>
                  <th>Book Title</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($order as $orders)
                <tr class="text-center">
                  <td class="pt-3">{{ $orders->updated_at }}</td>
                  <td class="pt-3">{{ $orders->user_id }}</td>
                  <td class="pt-3">
                    {{$orders->sales_rep}}
                  </td>
                  <td class="pt-3">
                    {{ $orders->remarks }}
                  </td>
                  <td>{{ $orders->customer_book }}</td>
                  @if($orders->sales_rep == Auth::user()->name)
                  <td>
                    <div class="row">
                      <div class="col-md-6">
                        <button type="button" class="btn btn-success col-12" data-toggle="modal" data-target="#activity{{ $orders->id }}">
                          Edit
                        </button>
                      </div>
                      <div class="col-md-6">
                        <a href="{{ route('DestroyActivity',[$orders->id]) }}" class="btn btn-danger delete-confirm col-12">Delete</a>
                      </div>
                    </div>
                  </td>
                  @endif
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>

        </div>
        <div class="card-footer">
          <div class="row">
            <div class="col-md-4">
              <input type="submit" value="Update Record" class="btn col-12 btn-success">
            </div>
            <div class="col-md-4">
              <button type="button" class="btn btn-primary col-12" data-toggle="modal" data-target="#exampleModalCenter">
                Add Activity
              </button>
            </div>
            <div class="col-md-4">
              <button type="button" class="btn text-white btn-info col-12" data-toggle="modal" data-target="#ConvertCustomer">
                Convert Customer
              </button>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-1">

      </div>
    </div>
  </div>
</form>

{{-- Add Activity --}}
<form action="{{ route('StoreOrder') }}" Method="POST">
  @csrf
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content bg-dark">
        <div class="modal-header text-center">
          <h5 class="modal-title text-white" id="exampleModalLongTitle">Add Details</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span class="text-white" aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="text" hidden name="user_id" value="{{Auth::user()->id; }}" id="" class="form-control ">
          @foreach ($customer as $row)
          <input type="text" hidden name="customer_id" value="{{$row->id}}" id="" class="form-control ">
          @endforeach
          <input type="text" name="customer_book" value="" placeholder="Book Title" id="" class="form-control mb-5">
          <p class="text-white">Choose Activity:</p>
          <input type="text" name="sales_rep" value="{{ Auth::user()->name; }}" id="" class="form-control">
          <select name="remarks" id="" class="form-control col-12" Value="Reply to Customer">
            <option value="Reply to Customer">Reply to Customer</option>
            <option value="Quote Sent">Quote Sent</option>
            <option value="Invoice Sent">Invoice Sent</option>
            <option value="1st Follow up">1st Follow up</option>
            <option value="2nd Follow up">2nd Follow up</option>
            <option value="3rd Follow up">3rd Follow up</option>
          </select>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <input type="submit" value="Add Activity" name="addactivitybtn" class="btn btn-success">
        </div>
      </div>
    </div>
  </div>
</form>
{{-- Add Activity --}}

{{-- Update Activity --}}
@foreach ($order as $row)
<form action="{{ route('UpdateActivity',[$row->id]) }}" Method="POST">
  @csrf
  <div class="modal fade" id="activity{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content bg-dark">
        <div class="modal-header text-center">
          <h5 class="modal-title text-white" id="exampleModalLongTitle">Add Details</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span class="text-white" aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="text" hidden name="" value="{{ $row->user_id }}" id="" class="form-control">
          <input type="text" name="customer_book" value="{{ $row->customer_book }}" placeholder="Book Title" id="" class="form-control mb-5">
          <p class="text-white">Update Activity:</p>
          <select name="remarks" id="" class="form-control col-12" Value="{{ $row->remarks }}">
            <option value="{{$row->remarks}}">{{ $row->remarks }}</option>
            <option value="Reply to Customer">Reply to Customer</option>
            <option value="Quote Sent">Quote Sent</option>
            <option value="Invoice Sent">Invoice Sent</option>
            <option value="1st Follow up">1st Follow up</option>
            <option value="2nd Follow up">2nd Follow up</option>
            <option value="3rd Follow up">3rd Follow up</option>
          </select>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <input type="submit" value="Update Remarks" name="addactivitybtn" class="btn btn-success">
        </div>
      </div>
    </div>
  </div>
</form>
@endforeach
{{-- Update Activity --}}

{{-- Convert Customer --}}
<form action="{{ route('convert') }}" Method="POST">
  @csrf
  <div class="modal fade" id="ConvertCustomer" tabindex="-1" role="dialog" aria-labelledby="ConvertCustomer" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content bg-dark">
        <div class="modal-header text-center">
          <h5 class="modal-title text-white" id="exampleModalLongTitle">Add Details</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span class="text-white" aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="text" hidden name="user_id" value="{{Auth::user()->id; }}" id="" class="form-control ">
          @foreach ($customer as $row)
          <input type="text" hidden name="customer_id" value="{{$row->id}}" id="" class="form-control ">
          @endforeach
          <input type="text" required name="customer_book" value="" placeholder="Book Title" id="" class="form-control mb-5">
          <input type="text" hidden name="sales_rep" value="{{ Auth::user()->name; }}" id="" class="form-control">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <input type="submit" value="Convert" name="addactivitybtn" class="btn btn-success">
        </div>
      </div>
    </div>
  </div>
</form>
{{-- Convert Customer --}}

<script>
  // SweetAlert2
  $('.delete-confirm').on('click', function(event) {
    event.preventDefault();
    const url = $(this).attr('href');
    Swal.fire({
      title: 'Are you sure?',
      text: "This activity will be deleted permanently",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ok!'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = url;
      }
    });
  });
  // SweetAlert2
  let reasonContainer = document.getElementById('reason_container')
  let reasonhold = document.getElementById('reasonhold')

  function show(select) {


    if (select.value === "Hold" || select === "Hold") {

      reasonhold.style.display = "block";
      document.getElementById('ReasonLost').style.display = "none";
      document.getElementById('reasonlabel').style.display = "block";

    } else if (select.value === "Lost" || select === "Lost") {
      document.getElementById('ReasonLost').style.display = "block";
      document.getElementById('reasonlabel').style.display = "block";
      reasonhold.style.display = "none";
    } else if (select.value === "Answered" || select === 'Answered') {
      document.getElementById('ReasonLost').style.display = "none";
      reasonhold.style.display = "none";
      document.getElementById('reasonlabel').style.display = "none";
    }else if (select.value === "Won" || select === 'Won') {
      document.getElementById('ReasonLost').style.display = "none";
      reasonhold.style.display = "none";
      document.getElementById('reasonlabel').style.display = "none";
    }

  }

  let getValue = document.querySelector('#customer_status_test').selectedOptions[0].value
  show(getValue)
</script>
@endsection
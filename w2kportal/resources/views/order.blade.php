@extends('layouts.app')

@section('content')
    @include('sweetalert::alert')

    @foreach ($customer as $customers)
        <form action="{{ route('UpdateOrder', $customers->id) }}" method="POST">
            @csrf
            <input type="text" name="updatestatuscustomerid" id="" value="{{ $customers->id }}" hidden>
            <input type="text" name="updatestatususerid" id="" value="{{ Auth::user()->id }}" hidden>
            <input type="text" name="updatestatususername" id="" value="{{ Auth::user()->name }}" hidden>

            <div class="container-fluid" id="main_container">
                <div class="row">
                    <div class="col-md-1">
                    </div>
                    <div class="col-md-10 bg-light mt-5">
                        <div class="card bg-light">
                            <div class="card-header bg-secondary">
                                <div class="row">
                                    <div class="col-md-9">
                                        <h1 class="text-white font-weight-bolder">Customer Information</h1>
                                    </div>
                                    <div class="col-md-3">
                                        <button type="button" class="btn btn-primary px-5 py-2" data-toggle="modal"
                                            data-target="#EditCustomer">
                                            Edit
                                        </button>
                                    </div>
                                </div>
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
                                        <p class="">{{ $customers->customer_fname }}
                                            {{ $customers->customer_lname }}</p>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <p for="emailaddress" class="text-dark col-md-2">Email Address:</p>
                                    <div class="col-md-6">
                                        <p>{{ $customers->customer_email }}</p>
                                    </div>
                                </div>
                                @if ($customers->secondary_email || $customers->fifth_email || $customers->fourth_email || $customers->third_email || $customers->second_email || $customers->first_email)
                                    <div class="form-group row">
                                        <p for="emailaddress" class="text-dark col-md-2">Alternate Email Address:</p>
                                        <div class="col-md-6">
                                            <p>
                                                @if ($customers->secondary_email)
                                                    {{ $customers->secondary_email }},
                                                @endif
                                                @if ($customers->first_email)
                                                    {{ $customers->first_email }},
                                                @endif
                                                @if ($customers->second_email)
                                                    {{ $customers->second_email }},
                                                @endif
                                                @if ($customers->third_email)
                                                    {{ $customers->third_email }},
                                                @endif
                                                @if ($customers->fourth_email)
                                                    {{ $customers->fourth_email }},
                                                @endif
                                                @if ($customers->fifth_email)
                                                    {{ $customers->fifth_email }}
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                @endif
                                <div class="form-group row">
                                    <label for="status" class="text-dark col-md-2">Status:</label>
                                    <div class="col-md-6">
                                        <select onchange="show(this)" name="customer_status" id="customer_status_test"
                                            class="form-control" value="{{ $customers->customer_status }}">
                                            <option selected value="{{ $customers->customer_status }}">
                                                {{ $customers->customer_status }}</option>
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
                                            @if ($customers->reason_lost == '')
                                                <option value="">--Please Select--</option>
                                            @else
                                                <option value="{{ $customers->reason_lost }}">
                                                    {{ $customers->reason_lost }}</option>
                                            @endif
                                            <option value="Stopped Replying">Stopped Replying</option>
                                            <option value="Can't Afford/Price Issues">Can't Afford/Price Issues</option>
                                            <option value="Found Another Company">Found Another Company</option>
                                            <option value="Change of Mind">Change of Mind</option>
                                            <option value="Personally formatted/book is formatted">Personally formatted/book
                                                is formatted</option>
                                            <option value="Trying to contact publisher">Trying to contact publisher</option>
                                            <option value="W2K Contact Issues">Website price or other issues</option>
                                            <option value="Email bounce">Email bounce</option>
                                            <option value="Still working on the project">Still working on the project
                                            </option>
                                        </select>
                                    </div>
                                    <div id="reasonhold" class="col-md-6">
                                        <input type="text" readonly placeholder="mm/dd/yyyy" class="form-control datepicker"
                                            value="{{ $customers->reason_hold_date }}" name="reason_hold_date" id="">
                                        <input name="reason_hold" placeholder="Reason for Holding Customer" id=""
                                            class="form-control" value="{{ $customers->reason_hold }}">
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
                    <td class="pt-3">{{ $orders->orderupdated }}</td>
                    <td class="pt-3">{{ $orders->user_id }}</td>
                    <td class="pt-3">
                        {{ $orders->sales_rep }}
                    </td>
                    <td class="pt-3">
                        {{ $orders->remarks }}
                    </td>
                    @if ($orders->remarks === 'Changed Book Title')
                        <td>{{ $orders->new_book }}<br>
                            <small>({{ $orders->old_book }})</small>
                        </td>
                    @else
                        <td>{{ $orders->customer_book }}<br>
                            @if ($orders->PackID === null)

                            @else
                                <small>
                                    ({{ $orders->package_name }})
                                </small>
                            @endif
                        </td>
                    @endif

                    @if ($orders->sales_rep == Auth::user()->name)
                        @if ($orders->PackID == null)
                            @if ($orders->remarks === 'Changed Book Title')
                                <td>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <a href="{{ route('customer', [$orders->book_id]) }}"
                                                class="btn btn-secondary col-12">View</a>
                                        </div>

                                        <div class="col-md-6">
                                            <a href="{{ route('destroyBook', [$orders->book_id]) }}"
                                                class="btn btn-danger delete-confirm col-12">Delete</a>
                                        </div>
                                    </div>
                                </td>
                            @else
                                <td>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button type="button" class="btn btn-success col-12" data-toggle="modal"
                                                data-target="#activity{{ $orders->ActivityID }}">
                                                Edit
                                            </button>
                                        </div>
                                        <div class="col-md-6">
                                            <a href="{{ route('DestroyActivity', [$orders->ActivityID]) }}"
                                                class="btn btn-danger delete-confirm col-12">Delete</a>
                                        </div>
                                    </div>
                                </td>
                            @endif
                        @else
                            <td>
                                <div class="row">
                                    <div class="col-md-6">
                                        <a href="{{ route('customer', [$orders->book_id]) }}"
                                            class="btn btn-secondary col-12">View</a>
                                    </div>

                                    <div class="col-md-6">
                                        <a href="{{ route('destroyBook', [$orders->book_id]) }}"
                                            class="btn btn-danger delete-confirm col-12">Delete</a>
                                    </div>
                                </div>
                            </td>
                        @endif
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
    </div>
    <div class="card-footer bg-secondary">
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
                <button type="button" class="btn text-white btn-info col-12" data-toggle="modal"
                    data-target="#ConvertCustomer">
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
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content bg-dark">
                    <div class="modal-header text-center">
                        <h5 class="modal-title text-white" id="exampleModalLongTitle">Add Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span class="text-white" aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="text" hidden name="user_id" value="{{ Auth::user()->id }}" id=""
                            class="form-control ">
                        @foreach ($customer as $row)
                            <input type="text" hidden name="customer_id" value="{{ $row->id }}" id=""
                                class="form-control ">
                        @endforeach
                        <input type="text" name="customer_book" value="" placeholder="Book Title" id=""
                            class="form-control mb-5">
                        <p class="text-white">Choose Activity:</p>
                        <input type="text" hidden name="sales_rep" value="{{ Auth::user()->name }}" id=""
                            class="form-control">
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
        <form action="{{ route('UpdateActivity', [$row->ActivityID]) }}" Method="POST">
            @csrf
            <div class="modal fade" id="activity{{ $row->ActivityID }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content bg-dark">
                        <div class="modal-header text-center">
                            <h5 class="modal-title text-white" id="exampleModalLongTitle">Update Details</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span class="text-white" aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="text" hidden name="" value="{{ $row->user_id }}" id="" class="form-control">
                            <input type="text" name="customer_book" value="{{ $row->customer_book }}"
                                placeholder="Book Title" id="" class="form-control mb-5">
                            <p class="text-white">Update Activity:</p>
                            <select name="remarks" id="" class="form-control col-12" Value="{{ $row->remarks }}">
                                <option value="{{ $row->remarks }}">{{ $row->remarks }}</option>
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
        <div class="modal fade" id="ConvertCustomer" tabindex="-1" role="dialog" aria-labelledby="ConvertCustomer"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content bg-dark">
                    <div class="modal-header text-center">
                        <h5 class="modal-title text-white" id="exampleModalLongTitle">Add Convert Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span class="text-white" aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="text" hidden name="user_id" value="{{ Auth::user()->id }}" id=""
                            class="form-control ">
                        @foreach ($customer as $row)
                            <input type="text" hidden name="customer_id" value="{{ $row->id }}" id=""
                                class="form-control ">
                        @endforeach
                        <input type="text" required name="customer_book" value="" placeholder="Book Title" id=""
                            class="form-control">
                        <input type="text" required name="transaction_id" value="" placeholder="Transaction ID" id=""
                            class="form-control mb-5">

                        <select name="Packages" class="form-control" id="orders_packages">
                            @foreach ($packages as $item)
                                <option value="{{ $item->id }}">{{ $item->package_name }}</option>
                            @endforeach
                        </select>
                        <select name="fixed_inclusion" class="form-control" id="fixed_inclusions">
                            <option value="Physical to Digital">Physical to Digital</option>
                            <option value="Physical to eBook">Physical to eBook</option>
                        </select>
                        <select name="fixed_editing" class="form-control" id="fixed_editing">
                            <option value="Copyediting">Copyediting</option>
                            <option value="Proofreading">Proofreading</option>
                            <option value="Development Editing">Development Editing</option>
                        </select>
                        <p class="text-white"><small>Note:</small> Choose One Only</p>
                        <input type="text" hidden name="sales_rep" value="{{ Auth::user()->name }}" id=""
                            class="form-control">
                        <input type="text" name="project_cost" placeholder="Total Project Cost" id="p_cost"
                            class="form-control">
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

    {{-- Edit Customer Details --}}
    @foreach ($customer as $customers)
        <form action="{{ route('updateCustomerInformation', [$customers->id]) }}" Method="POST">
            @csrf
            <div class="modal fade" id="EditCustomer" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content bg-dark">
                        <div class="modal-header text-center">
                            <h5 class="modal-title text-white" id="exampleModalLongTitle">Update Customer Details</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span class="text-white" aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="email" name="customer_email" value="{{ $customers->customer_email }}"
                                placeholder="Customer Email" required id="" class="form-control mb-5">
                            <p class="text-white"><small>You can Add on this following Details:</small></p>
                            <p class="text-white"><small>Note: This is only Optional</small></p>
                            <input class="form-control" type="email"
                                value="{{ $customers->secondary_email ? $customers->secondary_email : '' }}"
                                name="secondary_email" placeholder="Secondary Email" id="">
                            <input class="form-control" type="email"
                                value="{{ $customers->first_email ? $customers->first_email : '' }}" name="first_email"
                                placeholder="1st Email" id="">
                            <input class="form-control" type="email"
                                value="{{ $customers->second_email ? $customers->second_email : '' }}"
                                name="second_email" placeholder="2nd Email" id="">
                            <input class="form-control" type="email"
                                value="{{ $customers->third_email ? $customers->third_email : '' }}" name="third_email"
                                placeholder="3rd Email" id="">
                            <input class="form-control" type="email"
                                value="{{ $customers->fourth_email ? $customers->fourth_email : '' }}"
                                name="fourth_email" placeholder="4th Email" id="">
                            <input class="form-control" type="email"
                                value="{{ $customers->fifth_email ? $customers->fifth_email : '' }}" name="fifth_email"
                                placeholder="5th Email" id="">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input type="submit" value="Update Information" name="addactivitybtn" class="btn btn-success">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    @endforeach

    <script>
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
            } else if (select.value === "Won" || select === 'Won') {
                document.getElementById('ReasonLost').style.display = "none";
                reasonhold.style.display = "none";
                document.getElementById('reasonlabel').style.display = "none";
            }
        }
        $(document).ready(function() {
            $("#orders_packages").change(function() {
                var conceptName = $('#orders_packages').find(":selected").text();
                var p_cost = $('#p_cost');
                if (conceptName === 'Print Basic Package') {
                    p_cost.attr('readonly', 'readonly');
                    p_cost.val('149')
                } else if (conceptName === 'Print Deluxe Package') {
                    p_cost.attr('readonly', 'readonly');
                    p_cost.val('349')
                } else if (conceptName === 'Print Value Package') {
                    p_cost.attr('readonly', 'readonly');
                    p_cost.val('249')
                } else {
                    p_cost.removeAttr('readonly');
                    p_cost.val('');
                }
            });
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

            $('#fixed_editing, #fixed_inclusions').hide()
            $('#orders_packages').on('change', function() {
                if ($(this).val() === "11") {
                    $('#fixed_inclusions').show()
                } else {
                    $('#fixed_inclusions').hide()
                }
                if ($(this).val() === "12") {
                    $('#fixed_editing').show()
                } else {
                    $('#fixed_editing').hide()
                }
            })

            let getValue = document.querySelector('#customer_status_test').selectedOptions[0].value
            show(getValue)

        })
    </script>
@endsection

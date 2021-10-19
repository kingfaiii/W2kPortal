@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row ">
        <div class="col-md-12">
           
            <div class="card">
                <div class="card-header h3 font-weight-bold">
                    <div class="row">
                        <div class="col-md-8 pl-5">
                          
                           @foreach ($user as $item)
                               {{ $item->name }} Report Details
                           @endforeach
                          
                          
                        </div>
                        <div class="col-md-2">
                          
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <table id="customerlist_table" class="table table-stripped">
                                    <thead id="customerlist_header">
                                        <tr class="text-center">
                                            <th>Customer Name</th>
                                            <th>Email</th>
                                            <th>Remarks</th>
                                            <th>Activity Date & Time</th>
                                        </tr>
                                    </thead>
                                    <tbody id="customerlist_body">
                                       @foreach ($home as $row)
                                        <tr class="text-center">
                                            <td>{{ $row->customer_fname }} {{$row->customer_lname}}</td>
                                            <td>{{ $row->customer_email}}</td>
                                            <td>{{ $row->remarks }}</td>
                                            <td>{{ $row->created_at }}</td>
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
</div>
@endsection
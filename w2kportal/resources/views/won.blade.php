@extends('layouts.table')
@extends('layouts.app')

@section('content')

@section('header')
    <div class="col-md-8 pl-5">
        <h3 class="text-white font-weight-bold">
            {{ __('List of Won Customers') }}
        </h3>
    </div>
    <div class="col-md-4">
        <div class="row">
            <div class="col-md-6">
                <a href="{{ route('wonAdmin') }}" class="btn btn-primary mx-2 col-12">Admin</a>
            </div>
            <div class="col-md-6">
                <a href="{{ route('wonSupport') }}" class="btn btn-primary mx-2 col-12">Support</a>
            </div>
        </div>
    </div>
@endsection
@section('table')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <table id="customerlist_table" class="table table-stripped">
                    <thead id="customerlist_header">
                        <tr class="text-center">
                            <th>ID #</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="customerlist_body">
                        @foreach ($information as $row)
                            <tr class="text-center">
                                <td>W2k-{{ $row->customer_id }}</td>
                                <td>{{ $row->customer_fname }} {{ $row->customer_lname }}</td>
                                <td>{{ $row->customer_email }}</td>
                                <td>{{ $row->status }}</td>
                                <td>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <a href="{{ route('WonCustomersbooklist', [$row->customer_id]) }}"
                                                class="btn btn-success col-12">view</a>
                                        </div>

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
@endsection
@endsection

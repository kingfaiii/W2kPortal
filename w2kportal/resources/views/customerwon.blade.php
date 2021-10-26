@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row ">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    <div class="row h3 font-weight-bold">
                        <div class="col pl-5">
                            @foreach ($user as $item) 
                            {{ $item->customer_fname }} {{ $item->customer_lname }} List of Books
                            @endforeach
                        </div>
                    </div>

                </div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif


                    {{-- <div class=" h4 font-weight-bold">
                        <form action="" class="row" id="orders_form">
                            <div class="col-4">
                                <div class=" mr-4">
                                    <label for="">Date From: </label>
                                    <input type="date" class="form-control" id="orders_datefrom">
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="">
                                    <label for="">Date To: </label>
                                    <input type="date" class="form-control" id="orders_dateend">
                                </div>
                            </div>

                            <div class="col-4 text-center pt-4">
                                <button class="btn btn-primary" id="reports_refresh"><span class="glyphicon glyphicon-refresh"></span> Refresh</button>
                            </div>
                        </form>
                    </div> --}}

                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <table id="reports_table" class="table table-stripped">
                                    <thead id="reports_header">
                                        <tr class="text-center">
                                            <th>Book Title</th>
                                            <th>Transaction ID</th>
                                            <th>Action</th>     
                                        </tr>
                                    </thead>
                                    <tbody id="reports_body">
                                        @foreach ($information as $row)
                                        <tr class="text-center">
                                            <td>{{ $row->book_title }}</td>
                                            <td>{{ $row->transaction_ID }}</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <a href="{{route('customer',[$row->id])}}" class="btn btn-secondary col-12">Edit</a>
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
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
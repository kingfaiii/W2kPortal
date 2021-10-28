@extends('layouts.table')
@extends('layouts.app')

@section('content')
@section('header')
<div class="col pl-5">
    @foreach ($user as $item) 
    <h3 class="text-white font-weight-bold">
          {{ $item->customer_fname }} {{ $item->customer_lname }} Books
    </h3>
    @endforeach
</div>
@endsection
@section('table')
<div class="">
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
@endsection

@endsection
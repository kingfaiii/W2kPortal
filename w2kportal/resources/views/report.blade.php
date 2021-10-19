@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header h3 font-weight-bold">
                    <div class="row">
                        <div class="col-md-8 pl-5">
                            {{ __('List of Sales Rep') }}
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
                                            <th>ID #</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="customerlist_body">
                                        @foreach ($home as $row)
                                        <tr class="text-center">
                                            <td>W2k-{{ $row->id }}</td>
                                            <td>{{ $row->name }}</td>
                                            <td>{{ $row->email }}</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <a href="{{route('ReportList',[$row->id])}}" class="btn btn-success col-12">view</a>
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
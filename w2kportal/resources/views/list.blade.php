@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header h3 font-weight-bold">
                    <div class="row">
                        <div class="col-md-8 pl-5">
                            {{ __('List of Customers') }}
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
                                
                                <table class="table table-stripped">
                                    <thead>
                                        <tr class="text-center">
                                            <th>ID #</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       @foreach ($home as $row)
                                           <tr class="text-center">
                                            <td>W2k-{{ $row->id }}</td>
                                            <td>{{ $row->customer_fname }} {{$row->customer_lname}}</td>
                                            <td>{{ $row->customer_email }}</td>
                                            <td>{{ $row->customer_status }}</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <a href="{{route('order',[$row->id])}}" class="btn btn-success col-12">Edit</a>
                                                    </div>
                                                 
                                                    <div class="col-md-6">
                                                        <a href="{{ route('DestroyCustomer',[$row->id]) }}" class="btn btn-danger col-12 delete-confirm">Delete</a>
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
<script>
    $('.delete-confirm').on('click', function (event) {
        event.preventDefault();
        const url = $(this).attr('href');
    Swal.fire({
      title: 'Are you sure?',
      text: "This Customer will be deleted permanently",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = url;
      }
    });
    });
    </script>
@endsection

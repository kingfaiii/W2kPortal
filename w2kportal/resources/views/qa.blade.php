@extends('layouts.table')
@extends('layouts.app')
@include('sweet::alert')

@section('content')
@section('header')
    <div class="col-md-10">
        <h3 class="text-left text-white font-weight-bold">
            Quality Assurance List
        </h3>
    </div>
    <div class="col-md-2">
        <a type="button" href="#" class="btn btn-success col-5" data-toggle="modal" data-target="#exampleModalCenter"><i class="bi bi-person-plus-fill"></i> ADD</a>
    </div>
@endsection

@section('table')
    <table class="table table-stripped">
        <thead id="">
            <tr class="text-center">
                <th>ID #</th>
                <th>Name</th>
                <th>Email</th>
                <th>Date Created</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($qa as $item)
                <tr class="text-center">
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->qa_fname }} {{ $item->qa_lname }}</td>
                    <td>{{ $item->qa_email }}</td>
                    <td>{{ $item->created_at }}</td>
                    <td>
                        <div class="row">
                            <div class="col-md-6">
                                <a type="button" href="#" class="btn btn-success col-12" data-toggle="modal"
                                    data-target="#exampleModalCenter{{ $item->id }}">Edit</a>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('qaDelete', [$item->id]) }}" class="btn btn-danger col-12">Delete</a>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
{{-- Add qa Modal --}}
<form action="{{ route('qaCreate') }}" Method="POST">
    @csrf
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-secondary text-center">
                    <h5 class="modal-title text-white" id="exampleModalLongTitle">Add QA</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="text-white" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body py-4">
                    <input type="text" placeholder="Quality Assurance First Name" name="qa_fname" value="" id=""
                        class="form-control">
                    <input type="text" placeholder="Quality Assurance Last Name" name="qa_lname" value="" id=""
                        class="form-control">
                    <input type="text" placeholder="Quality Assurance Email Address" name="qa_email" value="" id=""
                        class="form-control">
                </div>
                <div class="modal-footer bg-secondary">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <input type="submit" value="Add" name="addcustomerbtn" class="btn btn-success">
                </div>
            </div>
        </div>
    </div>
    @include('sweet::alert')
</form>
{{-- Add qa Modal --}}

{{-- Update qa Modal --}}
@foreach ($qa as $item)
    <form action="{{ route('qaUpdate', [$item->id]) }}" Method="POST">
        @csrf

        <div class="modal fade" id="exampleModalCenter{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-secondary text-center">
                        <h5 class="modal-title text-white" id="exampleModalLongTitle">Add qa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span class="text-white" aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body py-4">
                        <input type="text" hidden name="qaID" value="" id="">
                        <input type="text" placeholder="Quality Assurance First Name" name="qa_fname"
                            value="{{ $item->qa_fname }}" id="" class="form-control">
                        <input type="text" placeholder="Quality Assurance Last Name" name="qa_lname"
                            value="{{ $item->qa_lname }}" id="" class="form-control">
                        <input type="text" placeholder="Quality Assurance Email Address" name="qa_email"
                            value="{{ $item->qa_email }}" id="" class="form-control">
                    </div>
                    <div class="modal-footer bg-secondary">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <input type="submit" value="Update" name="addcustomerbtn" class="btn btn-success">
                    </div>
                </div>
            </div>
        </div>

        @include('sweet::alert')
    </form>
@endforeach
{{-- Update Owner Modal --}}
@endsection

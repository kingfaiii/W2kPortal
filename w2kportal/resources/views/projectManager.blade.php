@extends('layouts.table')
@extends('layouts.app')

@section('content')
    @include('sweet::alert')
@section('header')
    <div class="col-md-10">
        <h3 class="text-left text-white font-weight-bold">
            Project Manager's
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
            @foreach ($pm as $projectManagers)
                <tr class="text-center">
                    <td>{{ $projectManagers->id }}</td>
                    <td>{{ $projectManagers->pm_fname }} {{ $projectManagers->pm_lname }}</td>
                    <td>{{ $projectManagers->pm_email }}</td>
                    <td>{{ $projectManagers->created_at }}</td>
                    <td>
                        <div class="row">
                            <div class="col-md-6">
                                <a type="button" href="#" class="btn btn-success col-12" data-toggle="modal"
                                    data-target="#exampleModalCenter{{ $projectManagers->id }}">Edit</a>
                            </div>
                            <div class="col-md-6">
                                <form action="{{ route('ProjectManager.destroy',[$projectManagers->id]) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                <button class="btn btn-danger col-12">Delete</button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
{{-- Add Owner Modal --}}
<form action="{{ route('ProjectManager.store') }}" Method="POST">
    @csrf
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-secondary text-center">
                    <h5 class="modal-title text-white" id="exampleModalLongTitle">Add Project Manager</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="text-white" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body py-4">
                    <input type="text" placeholder="Project Manager First Name" name="pm_fname" value="" id=""
                        class="form-control">
                    <input type="text" placeholder="Project Manager Last Name" name="pm_lname" value="" id=""
                        class="form-control">
                    <input type="email" name="pm_email" id="" placeholder="Project Manager Email" class="form-control">
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
{{-- Add Owner Modal --}}

{{-- Update Owner Modal --}}
@foreach ($pm as $projectManagers)
    <form action="{{ route('ProjectManager.update',[$projectManagers->id]) }}" Method="POST">
        @csrf
        @method('PUT')

        <div class="modal fade" id="exampleModalCenter{{ $projectManagers->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-secondary text-center">
                        <h5 class="modal-title text-white" id="exampleModalLongTitle">Add Owner</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span class="text-white" aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body py-4">
                        <input type="text" hidden name="ownerID" value="" id="">
                        <input type="text" placeholder="Owner First Name" name="pm_fname"
                            value="{{ $projectManagers->pm_fname }}" id="" class="form-control">
                        <input type="text" placeholder="Owner Last Name" name="pm_lname"
                            value="{{ $projectManagers->pm_lname }}" id="" class="form-control">
                        <input type="email" name="pm_email" value="{{ $projectManagers->pm_email }}" id="" class="form-control">
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

@extends('layouts.table')
@extends('layouts.app')

@section('content')
@include('sweet::alert')   
              @section('header')
                    <div class="col-md-10">
                      <h3 class="text-left text-white font-weight-bold">
                          Owner's List
                      </h3>
                    </div>
                    <div class="col-md-2">
                      <a type="button" href="#" class="btn btn-success col-5" data-toggle="modal" data-target="#exampleModalCenter">ADD</a>
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
                    @foreach ($owner as $item)
                    <tr class="text-center">
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->owner_fname }} {{ $item->owner_lname }}</td>
                        <td>{{ $item->owner_email }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>
                            <div class="row">
                                <div class="col-md-6">
                                    <a type="button" href="#" class="btn btn-success col-12" data-toggle="modal" data-target="#exampleModalCenter{{ $item->id }}">Edit</a>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('OwnerDelete',[$item->id]) }}" class="btn btn-danger col-12">Delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
              @endsection
    {{-- Add Owner Modal --}}
    <form action="{{ route('OwnerAdd') }}" Method="POST">
        @csrf
       <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
           <div class="modal-dialog modal-dialog-centered" role="document">
             <div class="modal-content">
               <div class="modal-header bg-secondary text-center">
                 <h5 class="modal-title text-white" id="exampleModalLongTitle">Add Owner</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span class="text-white" aria-hidden="true">&times;</span>
                 </button>
               </div>
               <div class="modal-body py-4">
                   <input type="text" placeholder="Owner First Name" name="owner_fname" value="" id="" class="form-control">
                   <input type="text" placeholder="Owner Last Name" name="owner_lname" value="" id="" class="form-control">
                   <input type="text" placeholder="Owner Email Address" name="owner_email" value="" id="" class="form-control">
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
    @foreach ($owner as $item)
    <form action="{{ route('OwnerUpdate',[ $item->id ]) }}" Method="POST">
        @csrf
       
       <div class="modal fade" id="exampleModalCenter{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                   <input type="text" placeholder="Owner First Name" name="owner_fname" value="{{ $item->owner_fname }}" id="" class="form-control">
                   <input type="text" placeholder="Owner Last Name" name="owner_lname" value="{{ $item->owner_lname }}" id="" class="form-control">
                   <input type="text" placeholder="Owner Email Address" name="owner_email" value="{{ $item->owner_email }}" id="" class="form-control">
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
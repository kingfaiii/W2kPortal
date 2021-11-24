@extends('layouts.table')
@extends('layouts.app')

@section('content')
@section('header')
    <div class="col-md-12">
        <h3 class="text-light font-weight-bold">{{ __('Sorted Won Customers for Admin') }}</h3>
    </div>
@endsection
@section('table')
    <table class="table table-stripped">
        <thead>
            <tr class="text-center">
                <th>Customer Name</th>
                <th>Service Name</th>
                <th>Amount</th>
                <th>Book Title</th>
                <th>Layout</th>
                <th>Page/Word Count</th>
                <th>Classification</th>
                <th>Commitment Date</th>
                <th>Owner</th>
                <th>Job Cost</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($getServiceInclusion as $InclusionsData)
                <form action="{{ route('adminStore', [$InclusionsData->id]) }}" method="post">
                    @csrf

                    <tr class="text-center">
                        <td>{{ $InclusionsData->custFname }} {{ $InclusionsData->custLname }}</td>
                        <td>{{ $InclusionsData->service_name }}</td>
                        <td>${{ $InclusionsData->project_cost ? $InclusionsData->project_cost : '0' }}</td>
                        <td>{{ $InclusionsData->bookTitle }}</td>
                        <td>{{ $InclusionsData->layout ? $InclusionsData->layout : 'No Layout' }}</td>
                        <td>{{ $InclusionsData->page_count ? $InclusionsData->page_count : 'No Page/Word Count' }}</td>
                        <td>{{ $InclusionsData->classification ? $InclusionsData->classificatoin : 'No Classification' }}
                        </td>
                        <td>{{ $InclusionsData->commitment_date ? $InclusionsData->commitment_date : 'No Commitment Date' }}
                        </td>
                        <td><select class="form-control w-auto" name="owner" id="">
                                @foreach ($ownerInformation as $owner)
                                    <Option value="{{ $owner->owner_fname }} {{ $owner->owner_lname }}">
                                        {{ $owner->owner_fname }} {{ $owner->owner_lname }}</Option>
                                @endforeach
                            </select></td>
                        <td><input class="form-control mx-auto ml-5 w-50" type="text" name="job_cost" id=""></td>
                        <td>
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="submit" value="Update" class="btn btn-success">
                                </div>
                            </div>
                        </td>
                    </tr>
                </form>
            @endforeach
        </tbody>
    </table>
@endsection
@endsection

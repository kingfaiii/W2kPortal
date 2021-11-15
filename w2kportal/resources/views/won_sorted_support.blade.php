@extends('layouts.table')
@extends('layouts.app')

@section('content')
@section('header')
    <div class="col-md-12">
        <h3 class="text-light font-weight-bold">{{ __('Sorted Won Customers for Support') }}</h3>
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
                <th>Assigned Date</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($getServiceInclusion as $InclusionsData)
                <form action="{{ route('supportStore', [$InclusionsData->id]) }}" method="post">
                    @csrf
                    <tr class="text-center">
                        <td>{{ $InclusionsData->custFname }} {{ $InclusionsData->custLname }}</td>
                        <td>{{ $InclusionsData->service_name }}</td>
                        <td>{{ $InclusionsData->project_cost }}</td>
                        <td>{{ $InclusionsData->bookTitle }}</td>
                        <td>{{ $InclusionsData->layout ? $InclusionsData->layout : 'No Layout' }}</td>
                        <td>{{ $InclusionsData->page_count ? $InclusionsData->page_count : 'No Page/Word Count' }}</td>
                        <td>{{ $InclusionsData->classification ? $InclusionsData->classificatoin : 'No Classification' }}
                        </td>
                        <td>{{ $InclusionsData->commitment_date ? $InclusionsData->commitment_date : 'No Commitment Date' }}
                        </td>
                        <td><input type="date" name="date_assigned" class="form-control" id=""></td>
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

@extends('layouts.table')
@extends('layouts.app')

@section('content')
    @section('header')
        <div class="col-md-12">
            <h1 class="text-white font-weight bolder">History</h1>
        </div>
    @endsection
@endsection

@section('table')
    <table class="table table-stripped">
        <thead>
            <tr class="text-center">
                <th>Service Name</th>
                <th>Layout</th>
                <th>Page/Word Count</th>
                <th>Project Classification</th>
                <th>Turnaround Time</th>
                <th>Status</th>
                <th>Task</th>
                <th>Commitment Date</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($history as $item)

            <tr class="text-center">
                <td>{{ $item->task }}</td>
                <td>{{ $item->name }}</td>
            </tr>
            @endforeach

        </tbody>
    </table>
@endsection
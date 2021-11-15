@extends('layouts.table')
@extends('layouts.app')

@section('content')
@section('header')
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-11">
                <h1 class="text-white font-weight bolder">History</h1>
            </div>
            <div class="col-md-1">
                <a href="{{ route('customer', [request()->segment(count(request()->segments()))]) }}"
                    class="btn btn-info mb-3 text-white mt-2">Book</a>
            </div>
        </div>
    </div>
@endsection
@endsection

@section('table')
<table class="table table-stripped table-wrapper-scroll-x my-custom-scrollbar">
    <thead>
        <tr class="text-center">
            <th>Service Name</th>
            <th>Layout</th>
            <th>Page/Word Count</th>
            <th>Project Classification</th>
            <th>Turnaround Time</th>
            <th>Status</th>
            <th>Commitment Date</th>
            <th>Owner</th>
            <th>Job Cost</th>
            <th>Date Assigned</th>
            <th>date_completed</th>
            <th>Quality Assurance</th>
            <th>Quality Score</th>
            <th>UID</th>
            <th>Project Link</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($history as $item)

            <tr class="text-center">
                <td>{{ $item['serName'] }}</td>
                @if ($item['layout'])
                    <td>{{ explode('*', $item['layout'])[0] }}<br><i><small>Updated By:
                                {{ $item['layout_by'] }}</small></i></td>
                @else
                    <td></td>
                @endif

                @if ($item['page_count'])
                    <td>{{ explode('*', $item['page_count'])[0] }}<br><i><small>Updated By:
                                {{ $item['page_count_by'] }}</small></i></td>
                @else
                    <td></td>
                @endif

                @if ($item['project_classification'])
                    <td>{{ explode('*', $item['project_classification'])[0] }}<br><i><small>Updated By:
                                {{ $item['project_classification_by'] }}</small></i></td>
                @else
                    <td></td>
                @endif

                @if ($item['turnaround_time'])
                    <td>{{ explode('*', $item['turnaround_time'])[0] }}<br><i><small>Updated By:
                                {{ $item['turnaround_time_by'] }}</small></i></td>
                @else
                    <td></td>
                @endif

                @if ($item['status'])
                    <td>{{ explode('*', $item['status'])[0] }}<br><i><small>Updated By:
                                {{ $item['status_by'] }}</small></i></td>
                @else
                    <td></td>
                @endif

                @if ($item['commitment_date'])
                    <td>{{ explode('*', $item['commitment_date'])[0] }}<br><i><small>Updated By:
                                {{ $item['commitment_date_by'] }}</small></i></td>
                @else
                    <td></td>
                @endif

                @if ($item['owner'])
                    <td>{{ explode('*', $item['owner'])[0] }}<br><i><small>Updated By:
                                {{ $item['owner_by'] }}</small></i></td>
                @else
                    <td></td>
                @endif

                @if ($item['job_cost'])
                    <td>{{ explode('*', $item['job_cost'])[0] }}<br><i><small>Updated By:
                                {{ $item['job_cost_by'] }}</small></i></td>
                @else
                    <td></td>
                @endif

                @if ($item['date_assigned'])
                    <td>{{ explode('*', $item['date_assigned'])[0] }}<br><i><small>Updated By:
                                {{ $item['date_assigned_by'] }}</small></i></td>
                @else
                    <td></td>
                @endif

                @if ($item['date_completed'])
                    <td>{{ explode('*', $item['date_completed'])[0] }}<br><i><small>Updated By:
                                {{ $item['date_completed_by'] }}</small></i></td>
                @else
                    <td></td>
                @endif

                @if ($item['quality_assurance'])
                    <td>{{ explode('*', $item['quality_assurance'])[0] }}<br><i><small>Updated By:
                                {{ $item['quality_assurance_by'] }}</small></i></td>
                @else
                    <td></td>
                @endif

                @if ($item['quality_score'])
                    <td>{{ explode('*', $item['quality_score'])[0] }}<br><i><small>Updated By:
                                {{ $item['quality_score_by'] }}</small></i></td>
                @else
                    <td></td>
                @endif

                @if ($item['uid'])
                    <td>{{ explode('*', $item['uid'])[0] }}<br><i><small>Updated By:
                                {{ $item['uid_by'] }}</small></i></td>
                @else
                    <td></td>
                @endif

                @if ($item['project_link'])
                    <td>{{ explode('*', $item['project_link'])[0] }}<br><i><small>Updated By:
                                {{ $item['project_link_by'] }}</small></i></td>
                @else
                    <td></td>
                @endif

                <td>{{ date('d/m/Y h:m:s', strtotime($item['created_at'])) }}</td>

            </tr>
        @endforeach

    </tbody>
</table>
@endsection

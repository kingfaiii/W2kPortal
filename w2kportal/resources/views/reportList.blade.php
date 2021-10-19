@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row ">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    <div class="row h3 font-weight-bold">
                        <div class="col pl-5">

                            @foreach ($user as $item)
                            {{ $item->name }} Report Details
                            @endforeach
                        </div>
                        <div class="col" id="reports_row_count">
                            Number of Rows: {{$count}}
                        </div>
                    </div>

                </div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif


                    <div class=" h4 font-weight-bold">
                        <form action="" class="row" id="orders_form">
                            <div class="col-4">
                                <div class=" mr-4">
                                    <label for="">Date From: </label>
                                    <input type="date" class="form-control" id="orders_datefrom">
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="">
                                    <label for="">Date To: </label>
                                    <input type="date" class="form-control" id="orders_dateend">
                                </div>
                            </div>

                            <div class="col-4 text-center pt-4">
                                <button class="btn btn-primary" id="reports_refresh"><span class="glyphicon glyphicon-refresh"></span> Refresh</button>
                            </div>
                        </form>
                    </div>

                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <table id="reports_table" class="table table-stripped">
                                    <thead id="reports_header">
                                        <tr class="text-center">
                                            <th>Customer Name</th>
                                            <th>Email</th>
                                            <th>Remarks</th>
                                            <th>Activity Date & Time</th>
                                        </tr>
                                    </thead>
                                    <tbody id="reports_body">
                                        @foreach ($home as $row)
                                        <tr class="text-center">
                                            <td>{{ $row->customer_fname }} {{$row->customer_lname}}</td>
                                            <td>{{ $row->customer_email}}</td>
                                            <td>{{ $row->remarks }}</td>
                                            <td>{{ $row->created_at }}</td>
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
    $(document).ready(function() {
        let baseURL = document.URL
        let old_state_url = baseURL

        function ajaxRequest(method = "GET", url, success = null, error = null) {
            $.ajax({
                type: method, //THIS NEEDS TO BE GET
                url: url,
                success: success,
                error: error
            });
        }

        function appendRow(arr = []) {
            $('#no-results').remove()
            $('#reports_body').empty()
            if (arr.table_data.length > 0) {
                arr.table_data.map(k => {
                    $('#reports_body').append(
                        `<tr class="text-center">
                            <td> ${k.customer_fname}  ${k.customer_lname}</td>
                            <td> ${k.customer_email}</td>
                            <td> ${k.remarks} </td>
                            <td> ${new Date(k.created_at).toISOString().slice(0, 19).replace('T', ' ')} </td>
                        </tr>`
                    )
                })
            } else {
                $('#reports_table').after('<h1 class="text-center" id="no-results">No Results Found</h1>')
            }

            $('#reports_row_count').text(`Number of Rows: ${arr.current_count}`)
        }

        $('#orders_dateend').on('change', function() {
            baseURL += `?date_from=${$('#orders_datefrom').val()}&date_to=${$(this).val()}&act=api`

            ajaxRequest('GET', baseURL, (arr, textStatus, xhr) => {
                if (xhr.status === 200) {
                    appendRow(arr)
                }
            })

            baseURL = old_state_url
        })

        $('#reports_refresh').on('click', function(e) {
            e.preventDefault()

            $("#orders_form :input").each(function() {
                $(this).val('')
            });

            baseURL += `?date_from=${$('#orders_datefrom').val()}&date_to=${$(this).val()}&act=api`

            ajaxRequest('GET', baseURL, (arr, textStatus, xhr) => {
                if (xhr.status === 200) {
                    appendRow(arr)
                }
            })

            baseURL = old_state_url

        })

    })
</script>
@endsection
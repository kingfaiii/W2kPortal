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
                        <form action="" id="customerForm_values">
                            <div class="row">
                                <div class="col">
                                    <label for="">Date From: </label>
                                    <input type="date" class="form-control" id="customers_datefrom">
                                </div>

                                <div class="col">
                                    <label for="">Date To: </label>
                                    <input type="date" class="form-control" id="customers_dateend">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="">Sort List: </label>
                                    <select class="custom-select" name="" id="customer_sort">
                                        <option value="" selected>-- Select Option ---</option>
                                        <option value="customer_fname">Firstname</option>
                                        <option value="customer_lname">Lastname</option>
                                        <option value="created_at">Date Created</option>
                                    </select>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="">Search List:</label>
                                        <input type="text" id="search_customers" class="form-control" placeholder="">
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="row">
                            <button class="btn btn-primary" id="customers_refresh"><span class="glyphicon glyphicon-refresh"></span> Refresh</button>
                            <div class="col-md-12">

                                <table id="customerlist_table" class="table table-stripped">
                                    <thead id="customerlist_header">
                                        <tr class="text-center">
                                            <th>ID #</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody id="customerlist_body">
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
                                                        <button data-id="{{$row->id}}" class="btn btn-danger col-12 delete-confirm">Delete</button>
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
    $(document).ready(function() {

        function ajaxRequest(method = "GET", url, success = null, error = null) {

            $.ajax({
                type: method, //THIS NEEDS TO BE GET
                url: url,
                success: success,
                error: error
            });
        }

        if (!$('#customers_datefrom').val()) {
            $('#customers_dateend').prop('disabled', true);
        }

        function getTableBody(arr = []) {
            $('#no-results').remove()
            $('#customerlist_body').empty()
            if (arr.length > 0) {
                arr.map((k, i) => {
                    $('#customerlist_body').append(
                        `   
                                <tr class="text-center">
                                    <td>W2k-${k.id}</td>
                                    <td>${k.customer_fname}  ${k.customer_lname}</td>
                                    <td>${k.customer_email} </td>
                                    <td>${k.customer_status}</td>
                                    <td>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <a href="/order/${k.id}" class="btn btn-success col-12">Edit</a>
                                            </div>

                                            <div class="col-md-6">
                                                <a data-id="${k.id}" class="btn btn-danger col-12 delete-confirm">Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            `
                    )
                })

            } else {
                $('#customerlist_table').after('<h1 class="text-center" id="no-results">No Results Found</h1>')
            }
        }

        $('.delete-confirm').each(function() {
            let self = this
            $(self).on('click', function(e) {
                e.preventDefault()
                let customer_id = $(this).data('id')
                const url = "{{route('DestroyCustomer', ['id'])}}".replace('id', customer_id)

                Swal.fire({
                    title: 'Are you sure?',
                    text: "This Customer will be deleted permanently",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then(result => {
                    if (result.isConfirmed) {
                        ajaxRequest('GET', url,
                            function(arr, textStatus, xhr) {
                                if (xhr.status === 200) {
                                    const refresh_url = `/customer/query?search_value=${$('#search_customers').val()}
                                            &order_by=${$('#customer_sort').val()}
                                            &date_from=${$('#customers_datefrom').val()}
                                            &date_to=${$('#customers_dateend').val()}&is_refresh=0`;

                                    ajaxRequest('GET', refresh_url,
                                        function(arr_refresh, textStatus_refresh, xhr_refresh) {
                                            if (xhr_refresh.status === 200) {
                                                getTableBody(arr_refresh)
                                            }
                                        },
                                        function(data) {
                                            console.log(data);
                                        })

                                }
                            },
                            function(data) {
                                console.log(data);
                            })
                    }
                })
            })


        });

        $('#customers_refresh').on('click', function() {
            const url = `/customer/query?search_value=${$('#search_customers').val()}
                            &order_by=${$('#customer_sort').val()}
                            &date_from=${$('#customers_datefrom').val()}
                            &date_to=${$('#customers_dateend').val()}&is_refresh=1`;

            $("#customerForm_values :input").each(function() {
                $(this).val('')
            });

            ajaxRequest('GET', url,
                function(arr, textStatus, xhr) {
                    if (xhr.status === 200) {
                        getTableBody(arr)
                    }
                },
                function(data) {
                    console.log(data);
                })
        })

        $('#customers_dateend').on('change', function() {
            const url = `/customer/query?order_by=${$('#customer_sort').val()}
            &search_value=${$('#search_customers').val()}&date_from=${$('#customers_datefrom').val()}
            &date_to=${this.value}&is_refresh=0`;
            ajaxRequest('GET', url,
                function(arr, textStatus, xhr) {

                    if (xhr.status === 200) {
                        getTableBody(arr)
                    }
                },
                function(data) {
                    console.log(data);
                })
        })

        $('#customers_datefrom').on('change', function() {
            if (this.value) {
                $('#customers_dateend').prop('disabled', false);
            }
        })

        $('#customer_sort').on('change', function() {
            const url = `/customer/query?order_by=${this.value}&search_value=${ $('#search_customers').val()}
            &date_from=${$('#customers_datefrom').val()}&date_to=${$('#customers_dateend').val()}&is_refresh=0`;
            ajaxRequest('GET', url,
                function(arr, textStatus, xhr) {

                    if (xhr.status === 200) {
                        getTableBody(arr)
                    }
                },
                function(data) {
                    console.log(data);
                })
        })

        $('#search_customers').keyup(function() {
            const search = $.trim($(this).val());
            const url = `/customer/query?search_value=${search}&order_by=${$('#customer_sort').val()}
            &date_from=${$('#customers_datefrom').val()}&date_to=${$('#customers_dateend').val()}&is_refresh=0`;
            // SET TIME OUT PARA DI MAGOVERLOAD YUNG SERVER
            if (search.length > 2) {
                setTimeout(() => {
                    ajaxRequest('GET', url,
                        function(arr, textStatus, xhr) {
                            if (xhr.status === 200) {
                                getTableBody(arr)
                            }
                        },
                        function(data) {
                            console.log(data);
                        })

                }, 300);
            }

            if (search.length === 0) {
                ajaxRequest('GET', url,
                    function(arr, textStatus, xhr) {
                        if (xhr.status === 200) {
                            getTableBody(arr)
                        }
                    },
                    function(data) {
                        console.log(data);
                    })
            }
        });


    })
</script>
@endsection
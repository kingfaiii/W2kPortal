@extends('layouts.app')


@section('content')
<main>
    <div>
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-2">
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h1 class="text-dark font-weight-bold text-center">Register Customer Information</h1>
                        </div>
                        <form action="" method="post">
                            <div class="card-body bg-warning">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="formGroupExampleInput">Full Name:</label>
                                            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Full Name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="formGroupExampleInput2">Email:</label>
                                            <input type="email" class="form-control" id="formGroupExampleInput2" placeholder="Email">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="PackagePurchased">Package Purchased:</label>
                                            <input type="text" placeholder="Package Purchased" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="TransactionID">Transaction ID:</label>
                                            <input type="text" placeholder="Transaction ID" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="PaymentDate">Payment Date:</label>
                                            <input type="date" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="Amount">Payment:</label>
                                            <input type="text" placeholder="$9999" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="Booktitle">Book Title:</label>
                                            <input type="text" name="" placeholder="Book Title" id="" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="Service">Service:</label>
                                              <select class="form-control">
                                                <option>Default select</option>
                                              </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="Service">Status:</label>
                                              <select class="form-control">
                                                <option>Default select</option>
                                              </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="CommitmmentDate">Commitment Date:</label>
                                            <input type="date" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="CompletedDate">Completed Date:</label>
                                            <input type="date" name="" id="" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="DownladableLink">Download Link:</label>
                                            <input type="text" class="form-control" placeholder="Download Link">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-6">
                                            <input class="btn btn-outline-success px-5 btn-lg col-md-12" type="submit" Value="Register" name="customerregbtn">
                                    </div>
                                    <div class="col-md-6">
                                        <input class="btn btn-danger px-5 btn-lg col-md-12" type="submit" Value="Cancel" name="customerregbtn">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-2">
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
@extends('layouts.app')


@section('content')
<main>
    <div class="form-container">
        <h3>Customer Feilds</h3>
        <form action="" method="get">
            <div class="container">
                <input type="text" name="customerName" id="cusomerName" placeholder="Customer name">
                <input type="email" name="email" id="email" placeholder="Email Address">
                <input type="text" name="package" id="package" placeholder="Package Purchase">
                <input type="text" name="transID" id="transID" placeholder="Transaction ID">
                <input type="date" name="paymentDate" id="paymentDate">
                <input type="number" name="amount" id="amnt" placeholder="0.00">
            </div>
            <div class="container">
                <input type="text" name="book" id="book" placeholder="Book Title">
                <input type="select" name="servce" id="servce" placeholder="Service">
                <input type="select" name="stat" id="stat" placeholder="Status">
                <input type="date" name="commitDate" id="commitData" placeholder="Commitment Date">
                <input type="date" name="completDate" id="completData" placeholder="Complited Date">
                <input type="text" name="dl" id="dl" placeholder="Download Link">
            </div>
        </form>
    </div>
    
</main>
@endsection
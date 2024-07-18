@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-6 p-3">
            <form action="{{route('pay')}}" method="POST">
                @csrf
                <div class="mb-3">
                    <h1>Payment Page</h1>
                    <p>Fill in the information below and click "Pay with ToyyibPay"</p>
                </div>
                <div class="mb-3">
                    <label for="name">Customer Name:</label>
                    <input placeholder="Enter your name" class="form-control" type="text" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="email">Customer Email:</label>
                    <input placeholder="Enter your email" class="form-control" type="email" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="phone">Customer Phone:</label>
                    <input placeholder="Enter your phone number" class="form-control" type="text" id="phone" name="phone" required>
                </div>
                <div class="mb-3">
                    <label for="amount">Amount (in MYR):</label>
                    <input value="10" class="form-control" type="number" id="amount" name="amount" step="0.01" required>
                </div>
                <button class="btn btn-success" type="submit">Pay with ToyyibPay</button>
            </form>
        </div>
    </div>
</div>


@endsection

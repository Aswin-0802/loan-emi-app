@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Loan Details</h3>
        <a href="{{ route('process.emi') }}" class="btn btn-primary">
            Process EMI
        </a>
    </div>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Client ID</th>
                <th>Number of Payments</th>
                <th>First Payment Date</th>
                <th>Last Payment Date</th>
                <th>Loan Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($loanDetails as $loan)
            <tr>
                <td>{{ $loan->clientid }}</td>
                <td>{{ $loan->num_of_payment }}</td>
                <td>{{ $loan->first_payment_date }}</td>
                <td>{{ $loan->last_payment_date }}</td>
                <td>{{ number_format($loan->loan_amount, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

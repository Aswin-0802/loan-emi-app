@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h3>Process EMI Data</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <form action="{{ route('emi.process') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary mt-3 mb-4">Process Data</button>
        </form>
        <a href="{{ route('emi.list') }}" class="btn btn-primary">
            View EMI
        </a>
    </div>

   
</div>
@endsection

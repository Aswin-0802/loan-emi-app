<!-- resources/views/emi/view.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h3>EMI Details</h3>

    @if ($emiDetails->isEmpty())
        <div class="alert alert-warning">No EMI data available.</div>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Client ID</th>
                    @foreach ($emiDetails->first() as $key => $value)
                        @if ($key !== 'clientid')
                            <th>{{ $key }}</th>
                        @endif
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($emiDetails as $emi)
                    <tr>
                        <td>{{ $emi->clientid }}</td>
                        @foreach ($emi as $key => $value)
                            @if ($key !== 'clientid')
                                <td>{{ number_format($value, 2) }}</td>
                            @endif
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection

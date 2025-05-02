@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h3>Process EMI Data</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('emi.process') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary mt-3 mb-4">Process Data</button>
    </form>

    @if(!empty($emiDetails) && count($emiDetails))
        <h4>EMI Details</h4>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Client ID</th>
                        @foreach(array_keys((array)$emiDetails[0]) as $key)
                            @if($key !== 'clientid')
                                <th>{{ $key }}</th>
                            @endif
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($emiDetails as $row)
                        <tr>
                            <td>{{ $row->clientid }}</td>
                            @foreach(array_keys((array)$row) as $key)
                                @if($key !== 'clientid')
                                    <td>{{ number_format($row->$key, 2) }}</td>
                                @endif
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p>No EMI data available. Please click "Process Data" to generate.</p>
    @endif
</div>
@endsection

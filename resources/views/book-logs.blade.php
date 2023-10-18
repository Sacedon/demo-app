@extends('base')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Logs</h1>

    <table class="table table-bordered">
        <thead class="bg-primary text-white">
            <tr>
                <th>Timestamp</th>
                <th>Log Entry</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($logEntries as $logEntry)
                <tr>
                    <td>{{ $logEntry->formattedCreatedAt }}</td>
                    <td>{{ $logEntry->log_entry }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

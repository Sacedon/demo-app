@extends('base')

@section('content')
    <div class="container">
        <h2>Borrow Request Details</h2>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Borrow Request for Book: {{ $borrow->book->title }}</h5>
                <p class="card-text">Return Date: {{ $borrow->return_date }}</p>
                <p class="card-text">Status: {{ $borrow->borrow_status }}</p>

                @if ($borrow->borrow_status == 'pending')
                    <form method="POST" action="{{ route('borrows.accept', $borrow->id) }}">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-success">Accept</button>
                    </form>

                    <form method="POST" action="{{ route('borrows.reject', $borrow->id) }}">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-danger">Reject</button>
                    </form>
                @endif

                <a href="{{ route('borrows.index') }}" class="btn btn-primary">Back to Borrow Requests</a>
            </div>
        </div>
    </div>
@endsection

@extends('base')

@section('content')
    <div class="container">
        <h2>Pending Borrow Requests</h2>

        @foreach($pendingBorrows as $borrow)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Borrow Request for Book: {{ $borrow->book->title }}</h5>
                    <p class="card-text">Return Date: {{ $borrow->return_date }}</p>
                    <p class="card-text">Status: {{ $borrow->borrow_status }}</p>
                    <a href="{{ route('borrows.show', $borrow->id) }}" class="btn btn-primary">View Details</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection

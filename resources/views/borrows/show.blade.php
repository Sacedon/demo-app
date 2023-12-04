@extends('base')

@section('content')
    <div class="container mt-4">
        <h2>Borrow Request Details</h2>

        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title mb-4">Borrow Request for Book: {{ $borrow->book->title }}</h5>

                <div class="row">
                    <div class="col-md-6">
                        <p class="card-text"><strong>Return Date:</strong> {{ $borrow->return_date }}</p>
                        <p class="card-text"><strong>Status:</strong> {{ $borrow->borrow_status }}</p>
                    </div>

                    @if ($borrow->borrow_status == 'pending')
                        <div class="col-md-6">
                            <form method="POST" action="{{ route('borrows.accept', $borrow->id) }}" class="d-flex mb-2">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-success flex-grow-1">Accept</button>
                            </form>

                            <form method="POST" action="{{ route('borrows.reject', $borrow->id) }}" class="d-flex">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-danger flex-grow-1">Reject</button>
                            </form>
                        </div>
                    @endif
                </div>

                <a href="{{ route('borrows.index') }}" class="btn btn-primary mt-3">Back to Borrow Requests</a>
            </div>
        </div>
    </div>
@endsection

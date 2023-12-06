@extends('base')

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h2 class="mb-0">Borrow Request Details</h2>
            </div>
            <div class="card-body">
                <h5 class="card-title mb-4">Borrow Request for Book: {{ $borrow->book->title }}</h5>

                <div class="row">
                    <div class="col-md-6">
                        @if ($borrow->book->image_path)
                            <img src="{{ asset('storage/' . $borrow->book->image_path) }}" alt="Book Cover" class="img-fluid mb-3 rounded">
                        @endif
                        <ul class="list-group">
                            <li class="list-group-item"><strong>Return Date:</strong> {{ $borrow->return_date }}</li>
                            <li class="list-group-item"><strong>Status:</strong> {{ $borrow->borrow_status }}</li>
                        </ul>
                    </div>

                    @if ($borrow->borrow_status == 'pending')
                        <div class="col-md-6">
                            <div class="mb-2">
                                <form method="POST" action="{{ route('borrows.accept', $borrow->id) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-success btn-lg btn-block">Accept</button>
                                </form>
                            </div>

                            <div>
                                <form method="POST" action="{{ route('borrows.reject', $borrow->id) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-danger btn-lg btn-block">Reject</button>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>

                <a href="{{ route('borrows.index') }}" class="btn btn-primary mt-3">Back to Borrow Requests</a>
            </div>
        </div>
    </div>
@endsection

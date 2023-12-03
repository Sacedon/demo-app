@extends('base')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-body">
            <h1 class="card-title mb-4">Borrow a Book</h1>

            <div class="mb-4">
                <h3>Book Details</h3>
                <p><strong>Title:</strong> {{ $book->title }}</p>
                <p><strong>Author:</strong> {{ $book->author }}</p>
                <p><strong>Status:</strong> {{ $book->status }}</p>
            </div>

            @if(session('error'))
                <div class="alert alert-danger mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('books.borrow', ['id' => $book->id]) }}">
                @csrf

                <div class="mb-3">
                    <label for="return_date" class="form-label">Return Date:</label>
                    <input type="date" id="return_date" name="return_date" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">Borrow Book</button>
            </form>
        </div>
    </div>
</div>
@endsection

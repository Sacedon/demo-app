    @extends('base')

    @section('content')
    <div class="container">
        <h2>View Book Details</h2>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><strong>Title:</strong> {{ $book->title }}</h5>
                <p class="card-text"><strong>Description:</strong> {{ $book->description }}</p>
                <p class="card-text"><strong>Author:</strong> {{ $book->author }}</p>
                <p class="card-text"><strong>Published Year:</strong> {{ $book->published_year }}</p>
                @if ($book->status == 'borrowed' && $book->borrows->first()->borrow_status == 'pending')

                    <p class="card-text"><strong>Status:</strong> Pending</p>
                @else
                    <p class="card-text"><strong>Status:</strong> {{ $book->status }}</p>
                @endif
                <p><strong>Created on:</strong> {{ $book->created_at->timezone('Asia/Manila')->format('F j, Y, g:i A') }}</p>

                <a href="{{ route('books.index') }}" class="btn btn-primary">Back to Book List</a>

                <a href="{{ route('books.borrow.form', $book->id) }}" class="btn btn-warning btn-sm">Requst To Borrow</a>

            </div>
        </div>
    </div>
    @endsection

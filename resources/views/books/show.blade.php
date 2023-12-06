@extends('base')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h2 class="mb-0">Book Details</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        @if ($book->image_path)
                            <img src="{{ asset('storage/' . $book->image_path) }}" alt="Book Cover" class="img-fluid rounded">
                        @endif
                    </div>
                    <div class="col-md-8">
                        <h2 class="card-title text-primary">{{ $book->title }}</h2>
                        <p class="card-text">{{ $book->description }}</p>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><strong>Author:</strong> {{ $book->author }}</li>
                            <li class="list-group-item"><strong>Published Year:</strong> {{ $book->published_year }}</li>
                            <li class="list-group-item">
                                <strong>Status:</strong>
                                @if ($book->status == 'borrowed' && $book->borrows->first()->borrow_status == 'pending')
                                    <span class="text-warning">Pending</span>
                                @else
                                    <span class="text-success">{{ $book->status }}</span>
                                @endif
                            </li>
                            <li class="list-group-item"><strong>Created on:</strong> {{ $book->created_at->timezone('Asia/Manila')->format('F j, Y, g:i A') }}</li>
                        </ul>
                        <div class="mt-3">
                            <a href="{{ route('books.index') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back to Book List</a>
                            @if ($book->status != 'borrowed' || $book->borrows->first()->borrow_status != 'pending')
                                <a href="{{ route('books.borrow.form', $book->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-book-reader"></i> Request To Borrow</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

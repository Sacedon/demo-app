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
            @if ($book->user)
                <p><strong>Added by:</strong> {{ $book->user->name }}</p>
            @else
                <p><strong>Added by:</strong> Unknown User</p>
            @endif
            <p><strong>Created on:</strong> {{ $book->created_at->timezone('Asia/Manila')->format('F j, Y, g:i A') }}</p>

            <a href="{{ route('books.index') }}" class="btn btn-primary">Back to Book List</a>
        </div>
    </div>
</div>
@endsection

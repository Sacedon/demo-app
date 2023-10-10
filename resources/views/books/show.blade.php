@extends('base')

@section('content')
<div class="container">
    <h2>View Book Details</h2>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $book->title }}</h5>
            <p class="card-text"><strong>Description:</strong> {{ $book->description }}</p>
            <p class="card-text"><strong>Author:</strong> {{ $book->author }}</p>
            <p class="card-text"><strong>Published Year:</strong> {{ $book->published_year }}</p>

            <a href="{{ route('books.index') }}" class="btn btn-primary">Back to Book List</a>
        </div>
    </div>
</div>
@endsection

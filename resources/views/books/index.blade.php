@extends('base')

@section('content')
<div class="container">
    <h2 class="mb-4">Book List</h2>

    @role('admin')
        <a href="{{ route('books.create') }}" class="btn btn-success mb-3">Add New Book</a>
    @endrole

    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="thead-light">
                <tr>
                    <th class="text-center">Book Image</th>
                    <th class="text-center">Title</th>
                    <th class="text-center">Description</th>
                    <th class="text-center">Author</th>
                    <th class="text-center">Published Year</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($books as $book)
                    <tr>
                        <td class="text-center">
                            @if ($book->image_path)
                                <img src="{{ asset('storage/' . $book->image_path) }}" alt="Book Cover" class="img-thumbnail rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">
                            @else
                                No Image
                            @endif
                        </td>
                        <td class="text-center">{{ $book->title }}</td>
                        <td class="text-center">{{ $book->description }}</td>
                        <td class="text-center">{{ $book->author }}</td>
                        <td class="text-center">{{ $book->published_year }}</td>
                        <td class="text-center">
                            <a href="{{ route('books.show', $book->id) }}" class="btn btn-info btn-sm">View</a>
                            @role('admin')
                                <a href="{{ route('books.edit', $book->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this book?')">Delete</button>
                                </form>
                            @endrole
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No books available.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();
        return view('books.index', compact('books'));
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'title' => 'required',
        'description' => 'required',
        'author' => 'required',
        'published_year' => 'required|integer',
    ]);

    $book = new Book([
        'title' => $request->input('title'),
        'description' => $request->input('description'),
        'author' => $request->input('author'),
        'published_year' => $request->input('published_year'),
    ]);

    if (Auth::check()) {
        $book->user_id = Auth::id();
    } else {
        // Handle the case when the user is not authenticated
        // You can redirect to a login page or display an error message
        return redirect()->route('loginForm')->with('error', 'Please log in to add a book.');
    }

    $book->save();

    return redirect()->route('books.index')->with('success', 'Book created successfully');
}

public function show(Book $book)
{
    return view('books.show', compact('book'));
}


    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'author' => 'required',
            'published_year' => 'required|integer',
        ]);

        $book->update($request->all());

        return redirect()->route('books.index')
            ->with('success', 'Book updated successfully');
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('books.index')
            ->with('success', 'Book deleted successfully');
    }
}

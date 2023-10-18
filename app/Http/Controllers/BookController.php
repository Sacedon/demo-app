<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\UserLog;

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

        $book = Book::create($request->all());
        $log_entry = Auth::user()->name . " added a book ". $book->name . " with the id# ". $book->id;
        event(new UserLog($log_entry));
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

    $data = $request->only(['title', 'description', 'author', 'published_year']);
    $book->update($data);

    $log_entry = Auth::user()->name . " updated a book " . $book->title . " with the id# " . $book->id;
    event(new UserLog($log_entry));

    return redirect()->route('books.index')
        ->with('success', 'Book updated successfully');
}


    public function destroy(Book $book)
    {
        $book->delete();
        $log_entry = Auth::user()->name . " deleted an book ". $book->name . " with the id# ". $book->id;
        event(new UserLog($log_entry));

        return redirect()->route('books.index')
            ->with('success', 'Book deleted successfully');
    }
}

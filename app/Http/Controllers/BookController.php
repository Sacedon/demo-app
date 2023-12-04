<?php

namespace App\Http\Controllers;

use App\Events\UserLog;
use App\Models\Book;
use App\Models\Borrow;
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

        $book = Book::create($request->all());
        $log_entry = Auth::user()->name . " added a book " . $book->title . " with the id# " . $book->id;
        event(new UserLog($log_entry));
        return redirect()->route('books.index')->with('success', 'Book created successfully');
    }

    public function show(Book $book)
{
    // Eager load the 'borrow' relationship
    $book = Book::with('borrows')->find($book->id);

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

        return redirect()->route('books.index')->with('success', 'Book updated successfully');
    }

    public function destroy(Book $book)
    {
        $book->borrows()->delete();
        $book->delete();
        $log_entry = Auth::user()->name . " deleted a book " . $book->title . " with the id# " . $book->id;
        event(new UserLog($log_entry));

        return redirect()->route('books.index')->with('success', 'Book deleted successfully');
    }

    public function showBorrowForm($id)
    {
        $book = Book::findOrFail($id);
        return view('books.borrow', compact('book'));
    }

    public function borrow(Request $request, $id)
    {
        $request->validate([
            'return_date' => 'required|date|after:today',
        ]);

        // Find the book by ID
        $book = Book::findOrFail($id);

        if ($book->status == 'available') {
            // Check if there is an existing pending borrow request for the book
            $pendingBorrow = Borrow::where('book_id', $book->id)
                ->where('borrow_status', 'pending')
                ->exists();

            if (!$pendingBorrow) {
                // Create a new Borrow record
                $borrow = new Borrow();
                $borrow->user_id = auth()->id();
                $borrow->book_id = $book->id;
                $borrow->return_date = $request->input('return_date');

                // Check if the book status is 'accepted'
                if ($book->status == 'accepted') {
                    $borrow->borrow_status = 'accepted';
                } else {
                    $borrow->borrow_status = 'pending';
                }

                $borrow->save();

                // Update book availability status
                $book->update(['status' => 'borrowed']);

                return redirect()->route('books.index')->with('status', 'Book Requested successfully!');
            } else {
                // There is already a pending borrow request for the book
                return redirect()->back()->with('error', 'There is already a pending borrow request for this book.');
            }
        } else {
            // Book is not available for borrowing
            return redirect()->back()->with('error', 'The book is not available for borrowing.');
        }

    }
}

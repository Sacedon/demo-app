<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Notifications\BorrowAccepted;
use App\Notifications\BorrowRejected;
use App\Models\Borrow;

class BorrowController extends Controller
{
    public function index()
    {
        $pendingBorrows = Borrow::where('borrow_status', 'pending')->get();
        return view('borrows.index', compact('pendingBorrows'));
    }

    public function show(Borrow $borrow)
    {
        return view('borrows.show', compact('borrow'));
    }

    public function accept(Borrow $borrow)
    {
        $borrow->update(['borrow_status' => 'accepted']);
        // Additional logic if needed

        // Update the book status to 'accepted'
        $book = Book::findOrFail($borrow->book_id);
        $book->update(['status' => 'borrowed']);

        $borrow->user->notify(new BorrowAccepted($borrow));

        return redirect()->route('borrows.index')->with('status', 'Borrow request accepted.');
    }

    public function reject(Borrow $borrow)
    {
        $borrow->update(['borrow_status' => 'rejected']);
        // Additional logic if needed

        // Update the book status to 'available' when the request is rejected
        $book = Book::findOrFail($borrow->book_id);
        $book->update(['status' => 'available']);

        $borrow->user->notify(new BorrowRejected($borrow));

        return redirect()->route('borrows.index')->with('status', 'Borrow request rejected.');
    }
}

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\NotificationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [AuthController::class, 'loginForm' ])->name('login');
Route::get('/register', [AuthController::class, 'registerForm' ]);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/login', [AuthController::class, 'login'])->name('login');


     Route::get('/books', [BookController::class, 'index'])->middleware('auth.dashboard', 'guest')->name('books.index');
     Route::get('/books/create', [BookController::class, 'create'])->middleware(['auth', 'role:admin'])->name('books.create');
     Route::post('/books', [BookController::class, 'store'])->middleware(['auth', 'role:admin'])->name('books.store');
     Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');
     Route::get('/books/{book}/edit', [BookController::class, 'edit'])->middleware(['auth', 'role:admin'])->name('books.edit');
     Route::put('/books/{book}', [BookController::class, 'update'])->middleware(['auth', 'role:admin'])->name('books.update');
     Route::delete('/books/{book}', [BookController::class, 'destroy'])->middleware(['auth', 'role:admin'])->name('books.destroy');
     Route::get('/book-logs', [LogController::class, 'index'])->middleware('auth.dashboard', 'guest')->name('book-logs');
     Route::get('/books/{id}/borrow', [BookController::class, 'showBorrowForm'])->name('books.borrow.form');
     Route::post('/books/{id}/borrow', [BookController::class, 'borrow'])->name('books.borrow');

     Route::resource('borrows', BorrowController::class);
     Route::patch('/borrows/{borrow}/accept', [BorrowController::class, 'accept'])->middleware(['auth', 'role:admin'])->name('borrows.accept');
Route::patch('/borrows/{borrow}/reject', [BorrowController::class, 'reject'])->middleware(['auth', 'role:admin'])->name('borrows.reject');




Route::get('verification/{user}/{token}', [AuthController::class, 'verification']);







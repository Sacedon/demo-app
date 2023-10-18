<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LogController;

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
     Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
     Route::post('/books', [BookController::class, 'store'])->name('books.store');
     Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');
     Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('books.edit');
     Route::put('/books/{book}', [BookController::class, 'update'])->name('books.update');
     Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('books.destroy');
     Route::get('/book-logs', [LogController::class, 'index'])->middleware('auth.dashboard', 'guest')->name('book-logs');



Route::get('verification/{user}/{token}', [AuthController::class, 'verification']);







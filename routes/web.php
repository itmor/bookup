<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', [IndexController::class, 'index'])->name('index');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->name('login.post')->middleware('guest');

Route::get('/register', [LoginController::class, 'showRegistrationForm'])->name('register')->middleware('guest');
Route::post('/register', [LoginController::class, 'register'])->name('register.post')->middleware('guest');

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
})->middleware('auth');

Route::get('/add_book', [BookController::class, 'showAddBookForm'])->name('book.add_book')->middleware('auth');
Route::post('/add_book', [BookController::class, 'addBook'])->name('book.add_book.post')->middleware('auth');
Route::get('/book/{id}', [BookController::class, 'show']);
Route::post('/add_rate_to_book', [BookController::class, 'addRateToBook'])->name('book.add_rate')->middleware('auth');

Route::get('/search', [BookController::class, 'showSearchForm'])->name('search');
Route::get('/search-results', [BookController::class, 'search'])->name('search.results');

Route::get('/get-new-books/{id}', [BookController::class, 'getNewBooks'])->name('get.new.books');

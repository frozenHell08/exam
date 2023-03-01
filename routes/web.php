<?php

use App\Models\Book;
use App\Http\Controllers\EntryController;
use App\Http\Controllers\Api\BookController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('home', [
        'books' => Book::all()
    ]);
});


Route::post('/', [EntryController::class, 'save']);
Route::patch('/{id}', [EntryController::class, 'update'])->name('book.update');
Route::post('/{id}', [EntryController::class, 'edit'])->name('book.edit');
Route::delete('/{id}', [EntryController::class, 'destroy'])->name('book.destroy');

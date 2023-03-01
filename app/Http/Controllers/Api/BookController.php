<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookRequest;
use App\Models\Book;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Response;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index() {
        $books = Book::all();
        
        return response()->json([
            'status' => true,
            'books' => $books
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        $details = $request->validate([
            'title' => ['required', 'max:255'],
            'author' => ['required', 'max:255'],
            'series' => ['required', 'max:255'],
            'pubmonth' => ['required']
        ]);

        $mydate = $request->date('pubmonth')->toDateTimeString();

        $year = Carbon::parse($mydate)->year;

        $book = Book::create([
            'title' => $details['title'],
            'series' => $details['series'],
            'author' => $details['author'],
            'publication_month' => Carbon::parse($details['pubmonth'])->format('F'),
            'publication_year' => Carbon::parse($details['pubmonth'])->year
        ]);

        // return redirect('/'); // ajax . redux state management, observe, observable
        return response()->json([
            'status' => true,
            'message' => "Book successfuly entered.",
            'book' => $book
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreBookRequest $request, Book $book)
    {
        $book->update($request->all());

        return response()->json([
            'status' => true,
            'message' => "Post has been updated lmao",
            'book' => $book
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return response()->json([
            'status' => true,
            'message' => "deleted"
        ], 200);
    }
}

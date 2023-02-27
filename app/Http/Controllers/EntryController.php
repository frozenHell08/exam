<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EntryController extends Controller
{
    public function save() {
        /**
         * comments (Joshua)
         * the validate part is to back-up the client side validation so that the input is being double-checked
         * in-case of bypass or browser errors.
         * 
         * The saving of the record in the database is configured like this because the publication month 
         * and year needed to be separated first before being saved in the database. 
         */

        $details = request()->validate([
            'title' => ['required', 'max:255'],
            'author' => ['required', 'max:255'],
            'series' => ['required', 'max:255'],
            'pubmonth' => ['required']
        ]);

        $mydate = request()->date('pubmonth')->toDateTimeString();
        $dt = Carbon::parse($mydate);
        
        $year = $dt->year;
        $month = $dt->format('F');

        $book = new Book;

        $book->title = $details['title'];
        $book->series = $details['series'];
        $book->author = $details['author'];
        $book->publication_month = $month;
        $book->publication_year = $year;

        $book->save();

        return redirect('/');
    }

    public function destroy($id) {
        /**
         * queries the Book table where the id is the one passed through the parameter.
         * the parameter id is connected through the action in the button and the route delete entry
         */
        $book = Book::where('id', $id)->firstorfail()->delete();
        return redirect('/');
    }

    public function edit($id) {
        return view('edit', [
            $book = Book::find($id),
            'title' => $book->title,
            'series' => $book->series,
            'author' => $book->author,
            $date = "{{$book->year}}, {{$book->month}}",
        ]);
    }

    public function update($id) {
        $book = Book::find($id);
        // $book->delete();
        $details = request()->validate([
            'title' => ['required', 'max:255'],
            'author' => ['required', 'max:255'],
            'series' => ['required', 'max:255'],
            'pubmonth' => ['required']
        ]);
        // $book = Book::where('id', $id)->firstorfail()->delete();

        $mydate = request()->date('pubmonth')->toDateTimeString();
        $dt = Carbon::parse($mydate);
        
        $year = $dt->year;
        $month = $dt->format('F');
        
        $book = new Book;
        $book->id = $id;
        $book->title = $details['title'];
        $book->series = $details['series'];
        $book->author = $details['author'];
        $book->publication_month = $month;
        $book->publication_year = $year;

        $book->save();

        return redirect('/');
    }
}

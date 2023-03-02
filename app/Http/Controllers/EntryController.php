<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EntryController extends Controller
{
    public function save() {
        $details = request()->validate([
            'title' => ['required', 'max:255'],
            'author' => ['required', 'max:255'],
            'series' => ['required', 'max:255'],
            'pubmonth' => ['required']
        ]);

        $mydate = request()->date('pubmonth')->toDateTimeString();
        var_dump($details['pubmonth']);
        $year = Carbon::parse($mydate)->year;

        // $book = Book::create([
        //     'title' => $details['title'],
        //     'series' => $details['series'],
        //     'author' => $details['author'],
        //     'publication_month' => Carbon::parse($details['pubmonth'])->format('F'),
        //     'publication_year' => Carbon::parse($details['pubmonth'])->year
        // ]);

        // return redirect('/'); // ajax . redux state management, observe, observable

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

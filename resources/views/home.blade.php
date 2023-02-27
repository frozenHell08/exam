<!-- comments (Joshua) 
Reference the blade component in replacement of using @\extends and @\section 
csrf is needed to fix the error 419 page expired when submitting a post request. 
with error 419, laravel is returning error because the token in the request is not matching up or is missing. 
sort of like connecting with starbucks wifi with a mcdo credentials. 
-->

<x-layout>
    <div id="contentbg" class="entryform">
        <div id="content">
            <h1 class="mine">Book Entry</h1>
            
            <form method="POST" action="/">
                @csrf
                <div id="credentials" class="form-group">
                    <label for="title">Book Title</label>
                    <input id="title" name="title" placeholder="Book Title" type="text" class="input" required />

                    <label for="series">Series</label>
                    <input id="series" name="series" placeholder="Series" type="text" class="input" />

                    <label for="author">Author</label>
                    <input id="author" name="author" placeholder="Author" type="text" class="input" required />
                    
                    <label for="pubmonth">Publication</label>
                    <input id="pubmonth" name="pubmonth" placeholder="Publication Month" type="month" class="input" required />
                </div>

                <hr>
                <input id="btnSubmit" type="submit" value="Add Book"/>
                <input id="btnReset" type="reset" value="Reset Fields"/> 
            </form>
        </div>
    </div>

    <div id="contentbg" class="displayarea">
        <h1>Book List</h1>
        <table class="table table-success w3-striped w3-hoverable">
            <thead>
                <th>Title</th>
                <th>Author</th>
                <th>Publication</th>
            </thead>

            <tbody>
                @foreach ($books as $book)
                    <tr>
                        <td>
                            {{ $book->title }}
                        </td>
                        <td>
                            {{ $book->author }}
                        </td>
                        <td>
                            {{ $book->publication_month }} {{ $book->publication_year }}
                        </td>
                        <td>
                            <form method="POST" action="{{route('book.edit', $book->id)}}">
                                @csrf
                                <button type="submit">Edit</button>
                            </form>
                        </td>
                        <td>
                            <form method="POST" action="{{route('book.destroy', $book->id)}}">
                                @csrf
                                @method('DELETE')
                                
                                <button type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach    
            </tbody>
        </table>
    </div>
</x-layout>
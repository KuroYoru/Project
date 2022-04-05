<?php

namespace App\Repositories\Eloquent;

use App\Models\Book;
use App\Repositories\Interfaces\BookRepositoryInterface;
use Illuminate\Http\Request;
use DB;

class BookRepository implements BookRepositoryInterface {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $books = DB::table('books')->paginate(5);
        return view('book.index', ['books' => $books]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('book.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $book = new Book();
        $book->bookName = $request->get('name');
        $book->bookDesc = $request->get('desc');
        $book->bookPrice = $request->get('price');
        $book->bookPrivilege = $request->get('priv');
        $book->save();
        return redirect('book/books')->with('success', 'A new book has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $books = DB::select('select * from books where id=?', [$id]);
        return view('book.show', ['books' => $books]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $book = Book::find($id);
        return view('book.edit', compact('book', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

        $book = Book::find($id);
        $book->bookName = $request->get('name');
        $book->bookDesc = $request->get('desc');
        $book->bookPrice = $request->get('price');
        $book->bookPrivilege = $request->get('priv');
        $book->save();
        return redirect('book/books');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $book = Book::find($id);
        $book->delete();
        return redirect('book/books')->with('success', 'A book has been deleted');
    }

    public function search(Request $request) {
        $search = $request->get('search');
        $books = DB::table('books')->where('bookName', 'like', '%' . $search . '%')->paginate(5);
        return view('book.index', ['books' => $books]);
    }

    public function bookXML() {
        $xmlString = file_get_contents(public_path('book.xml'));
        $xmlObject = simplexml_load_string($xmlString);
        echo"<br><br><br><br>";

        echo "<table border='1' cellpadding='10'>
                <thead>
                <tr>
                <th>ID</th>
                <th>Book Name</th>
                <th>Book Description</th>
                <th>Book Privilege</th>
                <th>Book Price (tokens)</th>
                <th>Created At</th>
                <th>Updated At</th>
                </tr>
                </thead>";
        foreach ($xmlObject as $book) {

            echo "
                <tbody>
                <tr>
                <td>" . $book->id . "</td>" .
            "<td>" . $book->bookName . "</td>" .
            "<td>" . $book->bookDesc . "</td>" .
            "<td>" . $book->bookPrivilege . "</td>" .
            "<td>" . $book->bookPrice . "</td>" .
            "<td>" . $book->created_at . "</td>" .
            "<td>" . $book->updated_at . "</td>" .
            "</tr>
                    ";
        }

        echo"</tbody>
                </table>";

        return view('bookXML');
    }

    public function buy($id) {
        $book = Book::find($id);
        return view('book.buy', compact('book', 'id'));
    }

    public function bought(Request $request) {
        $flag = 0;
        $users_books = DB::select('select * from users_books');
        $bookId = $request->get('bookID');
        $userId = $request->get('userID');
        if ($userId != null && $bookId != null) {
            foreach ($users_books as $userbook) {
                if ($userbook->userID == $userId && $userbook->bookID == $bookId) {
                    $flag = 1;
                }
            }
            $tokenCount = $request->get('userTokens');
            $price = $request->get('price');
            $finalTokenCount = $tokenCount - $price;
            if ($flag == 1) {
                $red = redirect('book/books')->with('Failed', 'You have already owned this book');
            } else {
                $posts = DB::insert('insert into users_books(userID, bookID) value (?, ?) ', [$userId, $bookId]);
                $minusToken = DB::update('update users set tokens=? where id=?', [$finalTokenCount, $userId]);
                if ($posts) {
                    $red = redirect('book/books')->with('Success', 'You now own this book');
                } else {
                    $red = redirect('book/books')->with('Failed', 'Unexepected Error Occured');
                }
            }
            return $red;
        }
    }

}

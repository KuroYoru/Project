<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use DB;

class BookController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $books = DB::table('books')->paginate(10);
        return view('index', ['books' => $books]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $book = new Book();
        $book->bookCode = $request->get('code');
        $book->bookName = $request->get('name');
        $book->bookDesc = $request->get('desc');
        $book->save();
        return redirect('books')->with('success', 'a new book has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $book = Book::find($id);
        return view('edit', compact('book', 'id'));
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
        $book->bookCode = $request->get('code');
        $book->bookName = $request->get('name');
        $book->bookDesc = $request->get('desc');
        $book->save();
        return redirect('books');
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
        return redirect('books')->with('Success', 'a book has been deleted');
    }

    public function search(Request $request) {
        $search = $request->get('search');
        $books = DB::table('books')->where('bookName', 'like', '%'.$search.'%')->paginate(5);
        return view ('index', ['books' => $books]);
    }
}
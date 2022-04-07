<?php

namespace App\Repositories\Eloquent;

use App\Models\Book;
use App\Repositories\Interfaces\BookRepositoryInterface;
use Illuminate\Http\Request;
use DB;
use DOMDocument;
use XSLTProcessor;

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
        $query = DB::select('select * from books');
        $booksArray = array();
        if ($result = $query) {
            echo "<br><br><br>";
            $xml = new DOMDocument("1.0");
            $xml->formatOutput = true;
            $bookelement = $xml->createElement("books");
            $xml->appendChild($bookelement);
            foreach ($query as $row) {
                $bookelement1 = $xml->createElement("book");
                $bookelement->appendChild($bookelement1);
                $rowArray = (array) $row;

                $id = $xml->createElement("id", $rowArray['id']);
                $bookelement1->appendChild($id);

                $bookName = $xml->createElement("bookName", $rowArray['bookName']);
                $bookelement1->appendChild($bookName);
                
                $bookDesc = $xml->createElement("bookDesc", $rowArray['bookDesc']);
                $bookelement1->appendChild($bookDesc);
                
                $bookPrivilege = $xml->createElement("bookPrivilege", $rowArray['bookPrivilege']);
                $bookelement1->appendChild($bookPrivilege);
                
                $bookPrice = $xml->createElement("bookPrice", $rowArray['bookPrice']);
                $bookelement1->appendChild($bookPrice);
                
                $created_at = $xml->createElement("created_at", $rowArray['created_at']);
                $bookelement1->appendChild($created_at);
                
                $updated_at = $xml->createElement("updated_at", $rowArray['updated_at']);
                $bookelement1->appendChild($updated_at);
            }
            $xml->save("book.xml");
        }
        
        $xmlString = new DOMDocument('1.0', 'UTF-8');
        $xmlString->load('book.xml');
        
        $xslString = new DOMDocument('1.0', 'UTF-8');
        $xslString->load('book.xsl');
        
        $xslt = new XSLTProcessor();
        $xslt->importStyleSheet($xslString);
        
        $xmldoc = new DOMDocument('1.0', 'UTF-8');
        $xmldoc->load("book.xml");
        
        print $xslt->transformToXML($xmldoc);

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
        }
        return $red;
    }

public function OwnedBookXML() {

        $query = DB::select('select * from users_books');
        $booksArray = array();
        if ($result = $query) {
            echo "<br><br><br>";
            $this->subSystemCreateXML($query);
            $this->loadXMLtoXSLT();
            return view('showOwnedBookXML');
        }
        else{
            echo "error";
            return redirect('book/books');
        }
    }

    public function subSystemCreateXML($query){
            $xml = new DOMDocument("1.0");
            $xml->formatOutput= true;
            $userbook=$xml->createElement("ownedbooks");
            $xml->appendChild($userbook);
            foreach($query as $row){
                $ownedbook=$xml->createElement("ownedbook");
                $userbook->appendChild($ownedbook);
                $rowArray = (array)$row;
                $userID = $xml->createElement("userID", $rowArray['userID']);
                $ownedbook->appendChild($userID);
                $bookID = $xml->createElement("bookID", $rowArray['bookID']);
                $ownedbook->appendChild($bookID);
            }
            $xml->save("ownedBook.xml");
    }

    public function loadXMLtoXSLT(){
        $xsl = new DOMDocument('1.0','UTF-8');
            $xsl->load("ownedBook.xsl");
            $xslt = new XSLTProcessor();
            $xslt->importStyleSheet($xsl);
            $xmldoc = new DOMDocument('1.0','UTF-8');
            $xmldoc->load("ownedBook.xml");
            print $xslt->transformToXML($xmldoc);
            
    }
    
    public function topup(){
        return view('book.topup');
    }
    
    public function topupped(Request $request){
        $amount = $request->get('topup');
        $userID = $request->get('userID');
        $originalTokenCount = $request->get('userTokens');
        $finalTokenCount = $originalTokenCount + $amount;
        $addToken = DB::update('update users set tokens=? where id=?', [$finalTokenCount, $userID]);
        if ($addToken) {
                    $red = redirect('book/books')->with('Success', 'You have successfully  topupped ?', $amount);
                } else {
                    $red = redirect('book/books')->with('Failed', 'Unexepected Error Occured');
                }
        return $red;
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(){
        return Book::all();
    }

    public function show($id){
        return Book::find($id);
    }

    public function destroy($id){
        Book::find($id)->delete();
        //még nem llétezik
      //  return redirect('/book/list');
    }

    public function update(Request $request, $id){
        $book = Book::find($id);
        $book->author = $request->author;
        $book->title = $request->title;
        $book->save();
      //  return redirect('/book/list');
    }

    public function store(Request $request){
        $book = new Book();
        $book->author = $request->author;
        $book->title = $request->title;
        $book->save();
       // return redirect('/book/list');
    }


    public function newView(){
        $books = Book::all();
        return view('book.new', ['books' => $books]);
    }

    public function editView($id){
        $books = Book::all();
        $book = Book::find($id);
        return view('book.edit', ['books' => $books, 'book' => $book]);
    }

    public function listView(){
        $books = Book::all();
        return view('book.list', ['books' => $books]);
    }

    //with fgvek
    public function bookCopy(){
        return Book::with('copy') -> get();
    }

}

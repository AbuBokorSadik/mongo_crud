<?php

namespace App\Http\Controllers;

use App\Model\MongoDb\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::get();

        return $books;
    }

    public function store(Request $request)
    {
        $book = new Book();
        $book->title = $request->title;
        $book->author = $request->author;
        $book->pages = $request->pages;
        $book->rating = $request->rating;
        $book->genres = $request->genres;
        $book->save();

        return $book;
    }

    public function update(Request $request)
    {
        $book = Book::find($request->id);
        $book->title = $request->title;
        $book->author = $request->author;
        $book->pages = $request->pages;
        $book->rating = $request->rating;
        $book->genres = $request->genres;
        $book->save();

        return $book;
    }

    public function delete(Request $request)
    {
        $book = Book::find($request->id);
        $book->delete();

        return $book;
    }
}

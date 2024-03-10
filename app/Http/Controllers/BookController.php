<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\BookCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class BookController extends Controller
{
    public function index(Request $request)
    {
        // if the request has data_count_shows
        if ($request->input('data_count_shows') != null) {
            $dataCountShows = $request->input('data_count_shows');
            $books = Book::where('user_id', Auth::id())->paginate($dataCountShows);
            return view('workspace.book.index', compact('books'));

        }
        // if the request has search
        if ($request->input('search') != null) {
            $books = Book::where('user_id', Auth::id())->where('title', 'like', '%' . $request->search . '%')->paginate(5);
            return view('workspace.book.index', compact('books'));
        }

        // get all the books
        $books = Book::where('user_id', Auth::id())->paginate(5);
        return view('workspace.book.index', compact('books'));
    }

    public function create()
    {
        // get all the categories
        $categories = BookCategory::where('user_id', Auth::id())->get();
        // return the create view
        return view('workspace.book.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // validate the request
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'author' => 'required',
            'category_id' => 'required',
            'publication_date' => 'required',
            'publisher' => 'required',
            'number_of_pages' => 'required|numeric',
        ]);

        // if the validation fails
       if ($validator->fails()) {
           Alert::error('Error', 'Please fill all the required fields.');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // create a new book
        $book = new Book();
        $book->title = $request->title;
        $book->author = $request->author;
        $book->category_id = $request->category_id;
        $book->publication_date = $request->publication_date;
        $book->publisher = $request->publisher;
        $book->number_of_pages = $request->number_of_pages;
        $book->user_id = Auth::id();
        $book->save();

        // return a success message
        Alert::success('Success', 'Book created successfully.');
        return redirect()->route('workspace.book.index')->with('success', 'Book created successfully.');
    }

    public function edit($id)
    {
        $book = Book::find($id);
        $categories = BookCategory::where('user_id', Auth::id())->get();
        return view('workspace.book.edit', compact('book', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'author' => 'required',
            'category_id' => 'required',
            'publication_date' => 'required',
            'publisher' => 'required',
            'number_of_pages' => 'required|numeric',
        ]);

         if ($validator->fails()) {
              Alert::error('Error', 'Please fill all the required fields.');
                return redirect()->back()->withErrors($validator)->withInput();
          }

        // update the book
        $book = Book::find($id);
        $book->title = $request->title;
        $book->author = $request->author;
        $book->category_id = $request->category_id;
        $book->publication_date = $request->publication_date;
        $book->publisher = $request->publisher;
        $book->number_of_pages = $request->number_of_pages;
        $book->save();

        // return a success message
        Alert::success('Success', 'Book updated successfully.');
        return redirect()->route('workspace.book.index')->with('success', 'Book updated successfully.');
    }

    public function destroy($id)
    {
        // delete the book
        $book = Book::find($id);
        $book->delete();

        // return a success message
        return redirect()->route('workspace.book.index')->with('success', 'Book deleted successfully.');
    }

}

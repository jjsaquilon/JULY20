<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;


class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $books = Book::all();
 return view('index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'book_name' => 'required|max:255',
            'isbn_no' => 'required|alpha_num',
            'book_price' => 'required|numeric',
            ]);
            $book = Book::create($validatedData);
          
 return redirect('/books')->with('success', 'Book is successfully saved');
 //$request->input('field_name'); // access an input field
// $request->has('field_name'); // check if field exists
 //$request->title; // dynamically access input fields
 //request('key') // you can use this global helper if needed inside a view
// return redirect('/books'); // to a specific url
 //return redirect(url('/books')); // to a specific url with url helper
 //return redirect(url()->previous()); // to a previous url
 //return redirect()->back(); // redirect back (same as above)
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $book = Book::findOrFail($id);
        return view('edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $validatedData = $request->validate([
            'book_name' => 'required|max:255',
            'isbn_no' => 'required|alpha_num',
            'book_price' => 'required|numeric',
            ]);
            Book::whereId($id)->update($validatedData);
            return redirect('/books')->with('success', 'Book is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $book = Book::findOrFail($id);
        $book->delete();
 return redirect('/books')->with('success', 'Book is successfully deleted');
    }
}

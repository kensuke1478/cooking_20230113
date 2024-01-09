<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\book;
use Illuminate\Support\Facades\Validator;



class BooksController extends Controller
{
    public function books()
    {
        $collection = Book::where('user_id', Auth::user()->id)->orderBy('created_at','desc')->paginate(5);
        return view('books', ['books' => $collection]);
    }
    public function create()
    {
        return view('create');
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'item_name' => 'required | min:3 | max:100',
            'item_purchase' => 'required | numeric',
            'item_amount' => 'required | numeric | between:1000,4000',
            'published' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('/books')->withInput()->withErrors($validator);
        }
        $book = new book;
        $book->item_name = $request->item_name;
        $book->item_purchase = $request->item_purchase;
        $book->item_amount = $request->item_amount;
        $book->user_id = $request->user_id;
        $book->published = $request->published;
        $book->save();
        $request->session()->flash('success','データを追加しました');
        return redirect('/');
    }
    public function destory(Book $book)
    {
        $book->delete();
        return redirect('/');
    }
    public function edit($book_id)
    {
        $book = Book::where('user_id', Auth::user()->id)->find($book_id);
        return view('edit', ['book' => $book]);
    }
    public function update(Request $request, Book $book)
    {
        $validator = Validator::make($request->all(), [
            'item_name' => 'required | min:3 | max:100',
            'item_purchase' => 'required | numeric',
            'item_amount' => 'required | numeric | between:1000,4000',
            'published' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect('/books/' . $book->id . '/edit')->withInput()->withErrors($validator);
        }
        $book->item_name = $request->item_name;
        $book->item_purchase = $request->item_purchase;
        $book->item_amount = $request->item_amount;
        $book->published = $request->published;
        $book->save();
        $request->session()->flash('update','データを編集しました');
        return redirect('/');
    }
    public function show(Book $book)
    {
        return view('show', ['book' => $book]);
    }
    public function auth()
    {
    $this->get('register', [Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
    }
    public function index()
    {
        $books = Book::orderBy('published','desc')->paginate(4);
        $auth = \Auth::user();
        return view('books', ['books' => $books, 'auth' => $auth]);
}
}

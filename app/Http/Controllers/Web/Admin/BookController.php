<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->string('q')->toString();
        $userId = $request->integer('user_id');

        $books = Book::with('user')
            ->when($q, fn($qry) =>
                $qry->where(function($w) use ($q){
                    $w->where('title','like',"%$q%")
                      ->orWhere('author','like',"%$q%");
                })
            )
            ->when($userId, fn($qry) => $qry->where('user_id', $userId))
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        $users = \App\Models\User::orderBy('name')->get(['id','name']);

        return view('admin.books.index', compact('books','q','userId','users'));
    }

    public function create()
    {
        $users = User::orderBy('name')->get(['id','name','email']);
        return view('admin.books.create', compact('users'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'author'      => 'required|string|max:255',
            'description' => 'nullable|string',
            'user_id'     => 'required|exists:users,id',
        ]);

        Book::create($data);
        return redirect()->route('admin.books.index')->with('success','Book created.');
    }

    public function edit(Book $book)
    {
        $users = User::orderBy('name')->get(['id','name','email']);
        return view('admin.books.edit', compact('book','users'));
    }

    public function update(Request $request, Book $book)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'author'      => 'required|string|max:255',
            'description' => 'nullable|string',
            'user_id'     => 'required|exists:users,id',
        ]);

        $book->update($data);
        return redirect()->route('admin.books.index')->with('success','Book updated.');
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return back()->with('success','Book deleted.');
    }
}

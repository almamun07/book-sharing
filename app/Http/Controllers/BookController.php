<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $user = JWTAuth::parseToken()->authenticate();

        $book = Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'description' => $request->description,
            'user_id' => $user->id,
        ]);

        return response()->json([
            'message' => 'Book shared successfully',
            'book' => $book
        ], 201);
    }
    public function nearby()
    {
        $user = JWTAuth::parseToken()->authenticate();

        $latitude = $user->latitude;
        $longitude = $user->longitude;
        $radius = 10; 

        $books = Book::select('books.*', DB::raw("(6371 * acos(
                cos(radians($latitude)) *
                cos(radians(users.latitude)) *
                cos(radians(users.longitude) - radians($longitude)) +
                sin(radians($latitude)) *
                sin(radians(users.latitude))
            )) AS distance"))
            ->join('users', 'books.user_id', '=', 'users.id')
            ->having('distance', '<=', $radius)
            ->orderBy('distance', 'asc')
            ->get();

      
        $books = $books->map(function($book) {
            return [
                'id' => $book->id,
                'title' => $book->title,
                'author' => $book->author,
                'description' => $book->description,
                'distance_km' => round($book->distance, 2),
                'user' => [
                    'id' => $book->user->id,
                    'name' => $book->user->name,
                ]
            ];
        });

        return response()->json([
            'books' => $books
        ]);
    }

}

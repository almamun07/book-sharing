<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Book;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class AdminController extends Controller
{
    private function checkAdmin()
    {
        $user = JWTAuth::parseToken()->authenticate();


        if ($user->is_admin != 1) {
            abort(response()->json(['error' => 'Unauthorized'], 403));
        }
        return $user;
    }

    public function users()
    {
        $this->checkAdmin();
        
        return response()->json([
            'users' => User::select('id', 'name', 'email', 'latitude', 'longitude', 'is_admin')->get()
        ]);
    }

    public function books()
    {
        $this->checkAdmin();
        return response()->json([
            'books' => Book::with('user:id,name')->get()
        ]);
    }

    public function deleteBook($id)
    {
        $this->checkAdmin();

        $book = Book::find($id);
        if (!$book) {
            return response()->json(['error' => 'Book not found'], 404);
        }

        $book->delete();
        return response()->json(['message' => 'Book deleted successfully']);
    }
}

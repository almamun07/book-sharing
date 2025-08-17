<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AdminController;



Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


Route::group(['middleware' => 'auth:api', 'admin'], function () {
    // User Routes
    Route::post('/books', [BookController::class, 'store']);
    Route::get('/books/nearby', [BookController::class, 'nearby']);

    // Admin Routes
    Route::get('/admin/users', [AdminController::class, 'users']);
    Route::get('/admin/books', [AdminController::class, 'books']);
    Route::delete('/admin/books/{id}', [AdminController::class, 'deleteBook']);
});

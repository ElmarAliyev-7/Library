<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{
    BookController,
    AuthController,
};

//Login
Route::post('/login', [AuthController::class, 'login'])->name('login');

//Book
Route::get('/books', [BookController::class, 'index']);
Route::get('/books/{book}', [BookController::class, 'show']);

Route::group(['middleware' => ['auth:sanctum', 'ability:company']], function () {
    //Book
    Route::put('/book/{id}', [BookController::class, 'update']);
    Route::delete('/book/{id}', [BookController::class, 'destroy']);
    Route::post('/book', [BookController::class, 'store']);

    Route::get('/authUser', [AuthController::class, 'authUser'])->name('auth-user');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});


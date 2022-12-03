<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{
    BookController,
};

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Book
Route::get('/books',        [BookController::class,'index']);
Route::get('/books/{book}', [BookController::class,'show']);
Route::post('/book',        [BookController::class,'store']);
Route::put('/book/{id}',    [BookController::class,'update']);
Route::delete('/book/{id}', [BookController::class,'destroy']);

//books -company_id (login crud)

<?php

use App\Http\Controllers\api\BookController;
use App\Http\Controllers\api\BorrowingRecordController;
use App\Http\Controllers\api\PatronController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::resource('books',BookController::class);
Route::resource('patrons',PatronController::class);
Route::post('/borrow/{bookId}/patron/{patronId}', [BorrowingRecordController::class, 'borrowBook']);
Route::put('/return/{bookId}/patron/{patronId}', [BorrowingRecordController::class, 'returnBook']);

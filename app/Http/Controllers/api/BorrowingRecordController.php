<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\BorrowingRecord;
use App\Models\Book;
use App\Models\Patron;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class BorrowingRecordController extends Controller
{
    public function borrowBook($bookId, $patronId)
    {

        $borrowingRecord = new BorrowingRecord();
        $borrowingRecord->book_id = $bookId;
        $borrowingRecord->patron_id = $patronId;
        $borrowingRecord->borrow_date = now();
        // You can set borrowing and return dates here
        $borrowingRecord->save();

        return response()->json($borrowingRecord, 201);
    }

    public function returnBook($bookId, $patronId)
    {
        // Find borrowing record
        $borrowingRecord = BorrowingRecord::where('book_id', $bookId)
            ->where('patron_id', $patronId)
            ->whereNull('return_date')
            ->firstOrFail();

        // Update return date
        $borrowingRecord->return_date = now();
        $borrowingRecord->save();

        return response()->json($borrowingRecord);
    }
}

<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\BorrowingRecord;
use App\Models\Book;
use App\Models\Patron;
use Tests\TestCase;

class BorrwingRecordTest extends TestCase
{
    /**
     * A basic feature test example.
     */

     use RefreshDatabase;

    public function testBorrowBook()
    {

        $book = Book::factory()->create();
        $patron = Patron::factory()->create();


        $response = $this->postJson("/api/borrow/{$book->id}/patron/{$patron->id}");

       
        $response->assertStatus(201);

        $this->assertDatabaseHas('borrowing_records', [
            'book_id' => $book->id,
            'patron_id' => $patron->id,
            'borrow_date' => now()->toDateTimeString()
        ]);
    }

    public function testReturnBook()
    {
        $book = Book::factory()->create();
        $patron = Patron::factory()->create();
         BorrowingRecord::factory()->create([
            'book_id' => $book->id,
            'patron_id' => $patron->id,
            'borrow_date' => now()->subDays(7),

        ]);
        $updatedData = [
        'update_date' => now(),
       ];


        $response = $this->putJson("/api/return/{$book->id}/patron/{$patron->id}",$updatedData);

        $response->assertStatus(200);



    }



    }


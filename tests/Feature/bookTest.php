<?php

namespace Tests\Feature;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class bookTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    
    public function testGetAllBooks()
    {
        $response = $this->get('/api/books');
        $response->assertStatus(200);
    }
    public function testCreateBook()
    {
        $bookData = Book::factory()->make()->toArray();

        $response = $this->post('/api/books', $bookData);
        $response->assertStatus(200);
    }


    public function tesGetBook()
    {
        $book = Book::factory()->create();

        $response = $this->get("/api/books/{$book->id}");
        $response->assertStatus(200);
    }

    public function testUpdateBook()
    {
        $book = Book::factory()->create();
        $updatedData = ['title' => 'Updated Title',"author"=>"update author","publication_year"=> 2015,"ISBN"=>"255"];

        $response = $this->put("/api/books/{$book->id}", $updatedData);
        $response->assertStatus(200);
    }

    public function testDeleteBook()
    {
        $book = Book::factory()->create();

        $response = $this->delete("/api/books/{$book->id}");
        $response->assertStatus(200);
    }
}

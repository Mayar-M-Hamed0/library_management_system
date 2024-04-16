<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BorrowingRecord>
 */
class BorrowingRecordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'book_id' => function () {
                return \App\Models\Book::factory()->create()->id;
            },
            'patron_id' => function () {
                return \App\Models\Patron::factory()->create()->id;
            },
            'borrow_date' => now(),
        ];
    }
}

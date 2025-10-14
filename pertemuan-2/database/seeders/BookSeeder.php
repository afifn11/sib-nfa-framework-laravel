<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $books = [
            ['title' => 'Harry Potter', 'author_id' => 1],
            ['title' => 'Game of Thrones', 'author_id' => 2],
            ['title' => 'Murder on the Orient Express', 'author_id' => 3],
            ['title' => 'The Shining', 'author_id' => 4],
            ['title' => 'The Hobbit', 'author_id' => 5],
        ];

        foreach ($books as $book) {
            Book::create($book);
        }
    }
}

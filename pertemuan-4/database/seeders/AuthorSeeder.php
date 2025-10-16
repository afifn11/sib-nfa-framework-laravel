<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Author;

class AuthorSeeder extends Seeder
{
    public function run(): void
    {
        $authors = [
            ['name' => 'J.K. Rowling'],
            ['name' => 'George R.R. Martin'],
            ['name' => 'Agatha Christie'],
            ['name' => 'Stephen King'],
            ['name' => 'J.R.R. Tolkien'],
        ];

        foreach ($authors as $author) {
            Author::create($author);
        }
    }
}

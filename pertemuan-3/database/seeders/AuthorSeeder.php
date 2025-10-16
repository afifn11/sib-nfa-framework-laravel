<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('authors')->insert([
            ['name' => 'J.K. Rowling', 'photo' => 'jk.jpg', 'bio' => 'Penulis Harry Potter'],
            ['name' => 'George R.R. Martin', 'photo' => 'grrm.jpg', 'bio' => 'Penulis Game of Thrones'],
            ['name' => 'Tere Liye', 'photo' => 'tere.jpg', 'bio' => 'Penulis asal Indonesia'],
            ['name' => 'Andrea Hirata', 'photo' => 'andrea.jpg', 'bio' => 'Penulis Laskar Pelangi'],
            ['name' => 'Agatha Christie', 'photo' => 'agatha.jpg', 'bio' => 'Penulis novel detektif'],
        ]);
    }
}

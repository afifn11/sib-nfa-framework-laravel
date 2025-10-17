<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('books')->insert([
            [
                'title' => 'Harry Potter and the Sorcerer\'s Stone',
                'description' => 'Novel fantasi sihir tentang seorang penyihir muda.',
                'price' => 160000.00,
                'stock' => 18,
                'cover_photo' => 'hp.jpg',
                'genre_id' => 1,
                'author_id' => 1
            ],
            [
                'title' => 'A Game of Thrones',
                'description' => 'Novel fantasi epik tentang perebutan tahta kerajaan.',
                'price' => 200000.00,
                'stock' => 15,
                'cover_photo' => 'got.jpg',
                'genre_id' => 1,
                'author_id' => 2
            ],
            [
                'title' => 'Hujan',
                'description' => 'Novel fiksi ilmiah tentang cinta dan bencana alam.',
                'price' => 120000.00,
                'stock' => 10,
                'cover_photo' => 'hujan.jpg',
                'genre_id' => 4,
                'author_id' => 3
            ],
            [
                'title' => 'Laskar Pelangi',
                'description' => 'Novel inspiratif tentang perjuangan anak-anak di Belitung untuk mendapatkan pendidikan.',
                'price' => 100000.00,
                'stock' => 30,
                'cover_photo' => 'lp.jpg',
                'genre_id' => 5,
                'author_id' => 4
            ],
            [
                'title' => 'And Then There Were None',
                'description' => 'Novel misteri tentang sepuluh orang asing yang terjebak di sebuah pulau.',
                'price' => 135000.00,
                'stock' => 25,
                'cover_photo' => null,
                'genre_id' => 3,
                'author_id' => 5
            ],
        ]);
    }
}

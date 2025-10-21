<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('genres')->insert([
            ['id' => 1, 'name' => 'Fantasy', 'description' => 'Cerita fiksi fantasi'],
            ['id' => 2, 'name' => 'Romance', 'description' => 'Cerita percintaan'],
            ['id' => 3, 'name' => 'Mystery', 'description' => 'Cerita misteri'],
            ['id' => 4, 'name' => 'Science Fiction', 'description' => 'Cerita fiksi ilmiah'],
            ['id' => 5, 'name' => 'Drama', 'description' => 'Cerita drama kehidupan'],
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('transactions')->insert([
            [
                'order_number' => 'ORD001',
                'customer_id' => 2, 
                'book_id' => 1,     
                'total_amount' => 160000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_number' => 'ORD002',
                'customer_id' => 3, 
                'book_id' => 2,     
                'total_amount' => 200000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_number' => 'ORD003',
                'customer_id' => 2, 
                'book_id' => 4,     
                'total_amount' => 100000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

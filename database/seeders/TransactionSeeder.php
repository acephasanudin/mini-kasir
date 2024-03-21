<?php

use Illuminate\Database\Seeder;
use App\Models\Transaction;

class TransactionSeeder extends Seeder
{
    public function run()
    {
        // Insert sample transactions
        Transaction::create([
            'user_id' => 1,
            'product_id' => 1,
            'quantity' => 2,
        ]);
        Transaction::create([
            'user_id' => 2,
            'product_id' => 2,
            'quantity' => 1,
        ]);
        // Add more sample transactions as needed
    }
}

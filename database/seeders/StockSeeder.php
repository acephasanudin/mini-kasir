<?php

use Illuminate\Database\Seeder;
use App\Models\Stock;

class StockSeeder extends Seeder
{
    public function run()
    {
        // Insert sample stock data
        Stock::create([
            'product_id' => 1,
            'quantity' => 100,
        ]);
        Stock::create([
            'product_id' => 2,
            'quantity' => 50,
        ]);
        // Add more sample stock data as needed
    }
}

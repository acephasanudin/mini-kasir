<?php

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // Insert sample products
        Product::create([
            'name' => 'Product 1',
            'price' => 10.99,
        ]);
        Product::create([
            'name' => 'Product 2',
            'price' => 20.50,
        ]);
        // Add more sample products as needed
    }
}

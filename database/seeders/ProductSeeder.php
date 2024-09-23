<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;  // ต้องทำการ import Model Product

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::create([
            'name' => 'Laptop',
            'description' => 'High performance laptop',
            'price' => 999.99,
            'quantity' => 10,
        ]);

        Product::create([
            'name' => 'Smartphone',
            'description' => 'Latest model smartphone',
            'price' => 699.99,
            'quantity' => 25,
        ]);

        Product::create([
            'name' => 'Headphones',
            'description' => 'Noise-cancelling headphones',
            'price' => 199.99,
            'quantity' => 15,
        ]);
    }
}

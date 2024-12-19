<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = [
            ['name' => 'Smartphone', 'description' => 'Um smartphone de última geração.', 'price' => 2500.00, 'amount' => 10],
            ['name' => 'Notebook', 'description' => 'Um notebook para uso profissional.', 'price' => 4500.00, 'amount' => 5],
            ['name' => 'Headset', 'description' => 'Fone de ouvido com microfone.', 'price' => 150.00, 'amount' => 25],
            ['name' => 'Mouse', 'description' => 'Mouse sem fio.', 'price' => 80.00, 'amount' => 50],
            ['name' => 'Teclado', 'description' => 'Teclado mecânico.', 'price' => 200.00, 'amount' => 30],
            ['name' => 'Monitor', 'description' => 'Monitor Full HD.', 'price' => 900.00, 'amount' => 15],
            ['name' => 'Impressora', 'description' => 'Impressora multifuncional.', 'price' => 1200.00, 'amount' => 8],
            ['name' => 'Caixa de Som', 'description' => 'Caixa de som Bluetooth.', 'price' => 300.00, 'amount' => 20],
            ['name' => 'HD Externo', 'description' => 'HD externo de 1TB.', 'price' => 400.00, 'amount' => 12],
            ['name' => 'Webcam', 'description' => 'Webcam Full HD.', 'price' => 250.00, 'amount' => 18],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}

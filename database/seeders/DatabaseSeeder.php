<?php

namespace Database\Seeders;

use App\Models\Product;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $products = Product::factory(100)->create();

        $ordersData = [];
        $orderProductsData = [];

        $batchSize = 50;
        $totalOrders = 1000;

        for ($i = 1; $i <= $totalOrders; $i++) {
            $orderDate = fake()->dateTimeBetween('2024-01-01', '2024-12-31');
            $customerName = fake()->name();
            $quantity = rand(1, 10);
            $price =  rand(100, 500);
            $total = $quantity * $price;

            $ordersData[] = [
                'id' => $i,
                'order_date' => $orderDate,
                'customer_name' => $customerName,
                'total' => $total,
                'created_at' => now(),
                'updated_at' => now()
            ];

            $selectedProducts = $products->random(rand(1, 5));

            foreach ($selectedProducts as $product) {
                $orderProductsData[] = [
                    'order_id' => $i,
                    'product_id' => $product->id,
                    'price' => $price,
                    'quantity' => $quantity,
                ];
            }

            if ($i % $batchSize === 0 || $i === $totalOrders) {

                DB::table('orders')->insert($ordersData);
                $ordersData = [];

                DB::table('order_product')->insert($orderProductsData);
                $orderProductsData = [];
            }
        }
    }
}

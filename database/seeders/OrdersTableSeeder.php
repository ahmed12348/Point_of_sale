<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orders=['order1','order2','order3'];
        foreach($orders as $order){
            Order::create([
                'category_id'=>1,
                'purchase_price'=>100,
                'sale_price'=>150,
                'stoke'=>100,

            ]);
        }
    }
}

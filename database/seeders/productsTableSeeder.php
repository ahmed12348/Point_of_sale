<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class productsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products=['product1','product2','product3'];
        foreach($products as $product){
            Product::create([
                'category_id'=>1,
                'ar'=>['name' => $product,'description'=>$product.' desc'],
                'en'=>['name' => $product,'description'=>$product.' desc'],
                'purchase_price'=>100,
                'sale_price'=>150,
                'sale_havegoml'=>0,
                'sale_goml'=>0,
                'stock'=>100,

            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clients=['ahmed','mohamed'];
        foreach($clients as $client){
            Client::create([
                'name'=>$client,
                'phone'=>'0122555100',
                'address'=>'maadi',
            ]);
        }
    }
}

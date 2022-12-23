<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Client;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class WelcomeController extends Controller
{
    public function index()
    {
        $data['categories_count']=Category::count();
        $data['products_count'] =Product::count();
        $data['clients_count']=Client::count();
        $data['users_count']=User::whereRoleIs('admin')->count();
        //        DB::raw('YEAR(created_at) year, MONTH(created_at) month')
         $data['sales_data']=Order::select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(total_price) as sum')
        )->groupBy('month')->get();
//dd($data['sales_data']);
        $user= User::all();
        return view('dashboard.welcome',$data);
    }
}


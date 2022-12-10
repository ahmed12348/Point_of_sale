<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders= Order::whereHas('client',function ($q) use ($request){
            return $q->where('name','like','%' .$request->search. '%');
//                ->orWhere('phone','like','%' .$request->search. '%')
//                ->orWhere('address','like','%' .$request->search. '%');
        })->latest()->paginate(5);

//        $clients= Client::when($request->search , function ($q) use ($request){
//            return $q->where('name','like','%' .$request->search. '%')
//                ->orWhere('phone','like','%' .$request->search. '%')
//                ->orWhere('address','like','%' .$request->search. '%');
//        })->latest()->paginate(5);

        return view('dashboard.orders.index',compact('orders'));
    }
}

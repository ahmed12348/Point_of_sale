<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
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
        return view('dashboard.orders.index',compact('orders'));
    }

    public function products($id)
    {
         $order=Order::findOrFail($id);
        $products= $order->products()->get();
//        dd($products);
        return view('dashboard.orders._products',compact('products','order'));
    }

    public function destroy($id)
    {
        $order=Order::findOrFail($id);
//        return $order->products()->pivot;
        foreach ($order->products as $product)
        {
//            return $product->pivot;
            $product->update([
                'stock' => $product->stock + $product->pivot->quantity
            ]);

            $product->pivot->delete();
        }

        $order->delete();
        session()->flash('success',__('site.deleted_successfully'));
        return redirect()->route('dashboard.orders.index');
    }
}

<?php

namespace App\Http\Controllers\Dashboard\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Client;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $clients= Client::paginate(5);


        $clients= Client::when($request->search , function ($q) use ($request){

            return $q->where('name','like','%' .$request->search. '%')
                ->orWhere('phone','like','%' .$request->search. '%')
                ->orWhere('address','like','%' .$request->search. '%');

        })->latest()->paginate(5);

        return view('dashboard.clients.index',compact('clients'));

    }
    public function create($id)
     {
         $client=Client::findOrFail($id);
         $categories =Category::with('products')->get();
       return view('dashboard.clients.orders.create',compact('client','categories'));
     }
    public function store(Request $request,$id)
    {
//        dd($request->all() );
         $client=Client::findOrFail($id);
         $request->validate([
            'products'=>'required|array',
        ]);
        //save in order
         $order = $client->orders()->create();
         $order->products()->attach($request->products);
         $total_price=0;

//  return $request->all;
        foreach ($request->products as $id => $quantity){
//                 return $quantity['quantity'];
//            dd($quantity['quantity']);
            $product=Product::findOrFail($id);
            $total_price +=$product->sale_price * $quantity['quantity'];
            $product->update([
                'stock' => $product->stock - $quantity['quantity']
            ]);
        }
        $order->update([
            'total_price' => $total_price
        ]);

        Session::flash('success',  __('site.created_successfully'));
        return redirect()->route('dashboard.orders.index');
    }


    public function edit($id,$o_id)
    {
        $orders= Order::paginate(5);
        $client=Client::findOrFail($id);
        $order=Order::findOrFail($o_id);
        $categories =Category::with('products')->get();

        return view('dashboard.clients.orders.edit',compact('client','order','categories','orders'));
    }

    public function update(Request $request,$id,$o_id)
    {
        dd($request->all());
        $client=Client::findOrFail($id);
        $order=Client::findOrFail($o_id);

        $request->validate([
            'name'=>'required',
            'phone.0'=>'required',
            'phone'=>'required|array|min:1',
            'address'=>'required',
        ]);
        $request_data=$request->all();
        $request_data['phone'] = array_filter($request->phone);
        $client->update($request_data);
        Session::flash('success',  __('site.created_successfully'));
        return redirect()->route('dashboard.clients.index');
    }


    public function destroy($id,$o_id)
    {
        $client=Client::findOrFail($id);
        $order=Client::findOrFail($o_id);
        $client->delete();
        Session::flash('success',  __('site.deleted_successfully'));
        return redirect()->route('dashboard.clients.index');

    }
}

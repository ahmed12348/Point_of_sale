<?php

namespace App\Http\Controllers\Dashboard\Client;

use App\Http\Controllers\Controller;
use App\Models\Client;
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

       return view('dashboard.clients.orders.create',compact('client'));
     }
    public function store(Request $request,$id)
    {
        $client=Client::findOrFail($id);
        $request->validate([
            'name'=>'required',
            'phone.0'=>'required',
            'phone'=>'required|array|min:1',
            'address'=>'required',
        ]);
        $request_data=$request->all();
        $request_data['phone'] = array_filter($request->phone);

        Client::create($request_data);
        Session::flash('success',  __('site.created_successfully'));
        return redirect()->route('dashboard.clients.index');
    }


    public function edit($id,$o_id)
    {
        $client=Client::findOrFail($id);
        $order=Client::findOrFail($o_id);
        return view('dashboard.clients.edit',compact('client'));
    }

    public function update(Request $request,$id,$o_id)
    {
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

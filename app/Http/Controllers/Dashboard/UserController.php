<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:users_read'])->only('index');
        $this->middleware(['permission:users_create'])->only('create');
        $this->middleware(['permission:users_update'])->only('edit');
        $this->middleware(['permission:users_delete'])->only('destroy');
    }

    public function index(Request $request)
    {

        $users =User::when($request->search,function($query) use ($request){
                return  $query->where('first_name','like','%'.$request->search. '%')
                    ->orWhere('last_name','like','%'.$request->search. '%');
        })->whereRoleIs('admin')->latest()->paginate(5);
        return view('dashboard.users.index',compact('users'));
    }


    public function create()
    {
        $users =User::all();
        $roles=Role::all();
        return view('dashboard.users.create',compact('users','roles'));
    }


    public function store(Request $request)
    {
//        dd($request->all());
        $request->validate([
            'first_name' => 'required',
            'email' => 'required',
            'password' => 'required|confirmed',
        ]);
        $request_data=$request->except(['password','password_confirmation','permissions','image']);
        $request_data['password']=bcrypt($request->password);

        if ($request->image){
            
        }

        $user=User::create($request_data);
        $user->attachRole('admin');
//        return $request->permissions;
        $user->syncPermissions($request->permissions);

        Session::flash('success',__( 'site.added_successfully'));
         return redirect()->route('dashboard.users.index');
    }


    public function show($id)
    {
    }


    public function edit($id)
    {
         $user=User::findOrFail($id);
        $users =User::all();
        $roles=Role::all();
        return view('dashboard.users.edit',compact('users','roles','user'));
    }

    public function update(Request $request,$id)
    {
        $user=User::findOrFail($id);
        $request->validate([
            'first_name' => 'required',
            'email' => 'required',

        ]);
        $request_data=$request->except(['permissions']);
        $user->update($request_data);
        $user->syncPermissions($request->permissions);

        Session::flash('success',  __('site.updated_successfully'));
        return redirect()->route('dashboard.users.index',compact('user'));
    }


    public function destroy($id)
    {
        $user=User::findOrFail($id);
        $user->delete();
        Session::flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.users.index');
    }
}

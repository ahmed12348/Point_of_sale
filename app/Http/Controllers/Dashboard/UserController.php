<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;



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

        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique',
            'password' => 'required|confirmed',
            'image' => 'image',
            'permissions' => 'required|min:1',
        ]);
        $request_data=$request->except(['password','password_confirmation','permissions','image']);
        $request_data['password']=bcrypt($request->password);

        if ($request->image){
            Image::make($request->image)->resize(300,null,function ($constraint){
                $constraint->aspectRatio();
            })->save(public_path('uploads/user_images/' . $request->image->hashName()));
            $request_data['image']=$request->image->hashName();
        }
//        dd($request_data);

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
            'email' => ['required',Rule::unique('users')->ignore($user->id),],
            'image' => 'image',
            'permissions' => 'required|min:1',
        ]);
        $request_data=$request->except(['permissions','image']);

        if ($request->image){
            if ($user->image != 'default.png'){
                Storage::disk('public_uploads')->delete('/user_images/'.$user->image);
            }
            Image::make($request->image)->resize(300,null,function ($constraint){
                $constraint->aspectRatio();
            })->save(public_path('uploads/user_images/' . $request->image->hashName()));
            $request_data['image']=$request->image->hashName();
        }

        $user->update($request_data);
        $user->syncPermissions($request->permissions);

        Session::flash('success',  __('site.updated_successfully'));
        return redirect()->route('dashboard.users.index',compact('user'));
    }


    public function destroy($id)
    {

        $user=User::findOrFail($id);
        if($user->image != 'default.png'){
            Storage::disk('public_uploads')->delete('/user_images/'.$user->image);
        }
        $user->delete();
        Session::flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.users.index');
    }
}

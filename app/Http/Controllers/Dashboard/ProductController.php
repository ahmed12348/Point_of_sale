<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        $categories =Category::all();

        $products= Product::when($request->search , function ($q) use ($request){
            return $q->whereTranslationLike('name','%' .$request->search. '%');

        })->when($request->category_id,function($q) use($request){

            return $q->where('category_id',$request->category_id);

        })->latest()->paginate(5);

        return view('dashboard.products.index',compact('products','categories'));
    }


    public function create()
    {
        $categories =Category::all();
        return view('dashboard.products.create',compact('categories'));
    }


    public function store(Request $request)
    {
//        $rules=[
//            'category_id'=>'required',
//        ];
//        dd($request->all());
        $rules=[
            'category_id'=>'required',
            'sale_price'=>'required',
//            'stock'=>'required',
        ];
        foreach (config('translatable.locales') as $locale){
            $rules +=[$locale.'.name' => 'required|unique:product_translations,name'];
            $rules +=[$locale.'.description' => 'required'];
        }

        $request->validate($rules);

       $request_data= $request->all();

        if ($request->image){
            Image::make($request->image)->resize(300,null,function ($constraint){
                $constraint->aspectRatio();
            })->save(public_path('uploads/product_images/' . $request->image->hashName()));
            $request_data['image']=$request->image->hashName();
        }
//        dd($request_data);

        $product=Product::create($request_data);
        Session::flash('success',  __('site.created_successfully'));
        return redirect()->route('dashboard.products.index');
    }


    public function show(Product $product)
    {
        //
    }

    public function edit($id)
    {
        $product=Product::findOrFail($id);
        $categories =Category::all();
        return view('dashboard.products.edit',compact('categories','product'));
    }


    public function update(Request $request,$id)
    {
        $product=Product::findOrFail($id);

        $rules=[
            'category_id'=>'required',
            'sale_price'=>'required',
        ];
//                en ar
        foreach (config('translatable.locales') as $locale){
            $rules +=[$locale.'.name' => ['required',Rule::unique("product_translations","name")->ignore($product->id,'product_id')]];
            $rules +=[$locale.'.description' => 'required'];
        }

        $request->validate($rules);

        $request_data= $request->all();



        if ($request->image){
            if ($product->image != 'default.png') {
                Storage::disk('public_uploads')->delete('/product_images/'.$product->image);
            }

            Image::make($request->image)->resize(300,null,function ($constraint){
                $constraint->aspectRatio();
            })->save(public_path('uploads/product_images/' . $request->image->hashName()));
            $request_data['image']=$request->image->hashName();
        }
//        dd($request_data);

        $product->update($request_data);
        Session::flash('success',  __('site.created_successfully'));
        return redirect()->route('dashboard.products.index');
    }


    public function destroy( $id)
    {
        $product =Product::findOrFail($id);
        if($product->image != 'default.png'){
            Storage::disk('public_uploads')->delete('/product_images/'.$product->image);
        }

        $product->delete();
        Session::flash('success',  __('site.deleted_successfully'));
        return redirect()->route('dashboard.products.index');

    }

}

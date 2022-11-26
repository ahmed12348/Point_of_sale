<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;


class CategoryController extends Controller
{
    public function index(Request $request)
    {
       $categories=Category::when($request->search,function ($q) use ($request){
           return $q->whereTranslationLike('name','%' .$request->search. '%');
//           where('name','like','%' .$request->search. '%');
       })->latest()->paginate(5);
       return view('dashboard.categories.index',compact('categories'));

    }

    public function create()
    {
        $categories=Category::paginate(5);
        return view('dashboard.categories.create',compact('categories'));
    }

    public function store(Request $request)
    {
       $rules=[];
       foreach (config('translatable.locales') as $locale){
           $rules +=[$locale.'.*' => 'required'];
           $rules +=[$locale.'.name' => [Rule::unique('category_translations','name')]];
       }
         $request->validate($rules);
        Category::create($request->all());
        Session::flash('success',  __('site.created_successfully'));
        return redirect()->route('dashboard.categories.index');

    }


    public function edit($id)
    {
        $category =Category::findOrFail($id);

        return view('dashboard.categories.edit',compact('category'));
    }

    public function update(Request $request,$id)
    {

        $category =Category::findOrFail($id);

        $rules=[];
        foreach (config('translatable.locales') as $locale){
            $rules +=[$locale.'.*' => 'required'];
            $rules +=[$locale.'.name' => [Rule::unique('category_translations','name')->ignore($category->id,'category_id')]];
        }
        $request->validate($rules);
        $category->update($request->all());
        Session::flash('success',  __('site.updated_successfully'));
        return redirect()->route('dashboard.categories.index');

    }

    public function destroy($id)
    {
        $category =Category::findOrFail($id);
//        return $request->all();
       ;

        $category->delete();
        Session::flash('success',  __('site.deleted_successfully'));
        return redirect()->route('dashboard.categories.index');

    }
}

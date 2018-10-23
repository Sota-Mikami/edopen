<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Category;

class CategoriesController extends Controller
{

    public function index(){
        $categories = Category::all();
        return view('category.index',compact('categories'));
    }

    public function store(Request $request){

        $category = new Category;
        $category->name = $request->category_name;
        $category->save();

        return redirect('/categories');

    }

    public function update(Request $request){
        $category = Category::find($request->category_id);
        $category->name = $request->category_name;
        $category->save();

        return redirect('/categories');
    }


    public function destroy(Request $request){
        // dd($request->id);
        // $category = Category::find($request->id);
        // $category->delete();
        Category::destroy($request->id);

        return redirect('/categories');
    }




}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
 
        return view('category.index',[
            'categories'=> $categories,
        ]);
    }

    public function create()
    {
        return view('category.create');
    }
 
 
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[        
            'name' => 'required|string|max:60|unique:categories,name',
        ],
        [
            'name.required' => 'Category cannot be empty',
            'name.unique' => 'Category already exists',
        ],   
    );

    if($validator->fails()){
        return redirect()->back()->withInput($request->all())->withErrors($validator);
    }
 
       $category = Category::create([
            'name'=> $request->name,
            'user_id'=> Auth::user()->id,
        ]);
        if ($category) {
            return redirect()->route('category')->with([
                    'success' => 'Category created successfully'
                ]);
        } 

    }
 
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[        
                'name' => 'required|string|max:60|unique:categories,name',
            ],
            [
                'name.required' => 'Category cannot be empty',
                'name.unique' => 'Category already exists',
            ],   
        );

        if($validator->fails()){
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        $category = Category::findOrFail($id);

        $category->update([
            'name'=> $request->name,
        ]);

        if ($category) {
            return redirect()->route('category')->with([
                    'success' => 'Category updated successfully'
                ]);
        } 
    
    }
 
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        if ($category) {
            return redirect()->route('category')->with([
                    'success' => 'Category deleted successfully'
                ]);
        } 
    }
}

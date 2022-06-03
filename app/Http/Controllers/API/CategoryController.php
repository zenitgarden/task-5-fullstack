<?php

namespace App\Http\Controllers\API;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {

        $category = Category::all();
        return response()->json([
        "success" => 200,
        "message" => "Categories List",
        "data" => $category
        ]);
    }
 
    public function show($id)
    {
        $category = Category::find($id);
        if (is_null($category)) {
            return response()->json([
                "error" => 401,
                "message" => "Not found",
                ]);
        }
        return response()->json([
        "success" => 200,
        "message" => "Category retrieved successfully.",
        "data" => $category
        ]);
    }
 
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $category = Category::create([
            'name'=> $request->name,
            'user_id'=> Auth::user()->id,
        ]);
                return response()->json([
                "success" => 200,
                "message" => "Category created successfully.",
                "data" => $category
            ]);
    }
 
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

    
        try {
            $category = Category::findOrFail($id);
        } catch (\Throwable $th) {
            return response()->json([
                "error" => 401,
                "message" => "Id Not found",
                ]);
        }
        
        $data = [
            'name'=> $request->name,
        ];
        $category->update($data);
                return response()->json([
                "success" => true,
                "message" => "category updated successfully.",
                "data" => $category
            ]);
        
    }
 
    public function delete($id)
    {
        try {
            $category = Category::findOrFail($id);
            if ($category->delete()) {
                return response()->json([
                    'success' => 200,
                    "message" => "category deleted successfully",
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                "error" => 401,
                "message" => "Id Not found",
                ]);
        }
 
    }
}

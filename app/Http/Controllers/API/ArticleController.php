<?php

namespace App\Http\Controllers\API;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function index()
    {

        $article = Article::paginate(5);
        return response()->json([
        "success" => 200,
        "message" => "Article List",
        "data" => $article
        ]);
    }
 
    public function show($id)
    {
        $article = Article::find($id);
        if (is_null($article)) {
            return response()->json([
                "error" => 401,
                "message" => "Not found",
                ]);
        }
        return response()->json([
        "success" => 200,
        "message" => "Article retrieved successfully.",
        "data" => $article
        ]);
    }
 
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'image' => 'required',
            'content' => 'required',
            'category_id' => 'required'
        ]);
        $article = Article::create([
            'title'=> $request->title,
            'image'=> $request->image,
            'content'=> $request->content,
            'category_id'=> $request->category_id,
            'user_id'=> Auth::user()->id,
        ]);
                return response()->json([
                "success" => 200,
                "message" => "Article created successfully.",
                "data" => $article
            ]);
    }
 
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'image' => 'required',
            'content' => 'required',
            'category_id' => 'required'
        ]);

    
        try {
            $article = Article::findOrFail($id);
        } catch (\Throwable $th) {
            return response()->json([
                "error" => 401,
                "message" => "Id Not found",
                ]);
        }
        

        $data = [
            'title'=> $request->title,
            'image'=> $request->image,
            'content'=> $request->content,
            'category_id'=> $request->category_id,
        ];
        $article->update($data);
                return response()->json([
                "success" => true,
                "message" => "Article updated successfully.",
                "data" => $article
            ]);
        
    }
 
    public function delete($id)
    {
        try {
            $article = Article::findOrFail($id);
            if ($article->delete()) {
                return response()->json([
                    'success' => 200,
                    "message" => "Article deleted successfully",
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

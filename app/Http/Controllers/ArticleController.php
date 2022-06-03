<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class ArticleController extends Controller
{
    public function index()
    {

        $articles = Article::all();
        return view('article.index',[
            'articles' => $articles,
        ]);
    }
 
    public function show($id)
    {
        $categories = Category::all();
        $article = Article::findOrFail($id);
        return view('article.show', compact('article','categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('article.create',[
            'categories' => $categories
        ]);
    }
 
    public function store(Request $request)
    {
        $validator = $request->validate([
            'title'=> 'required|string|max:250',
            'image'=> 'image',
            'content'=> 'required',
            'category_id'=> 'required',
        ],
        [
            'title.required' => 'Title cannot be empty',
            'image.required' => 'Please Choose image ',
            'image.image' => 'The type file should be an image',
            'content.required' => 'Content cannot be empty',
            'category_id.required'=> 'Please Choose category !',
        ]);

        if($request->file('image')){
            $validator['image'] = $request->file('image')->store('images');
        }

        $validator['user_id'] = Auth::user()->id;

        Article::create($validator);

    
        return redirect()->route('article')->with([
            'success' => 'Article created successfully'
        ]);
        
    
        
    }


    public function edit($id)
    {
        $categories = Category::all();
        $article = Article::findOrFail($id);
        return view('article.edit', compact('article','categories'));
    }
 
    public function update(Request $request, $id)
    {
        $validator = $request->validate([
            'title'=> 'required|string|max:250',
            'image'=> 'image',
            'content'=> 'required',
            'category_id'=> 'required',
        ],
        [
            'title.required' => 'Title cannot be empty',
            'image.required' => 'Please Choose image ',
            'image.image' => 'The type file should be an image',
            'content.required' => 'Content cannot be empty',
            'category_id.required'=> 'Please Choose category !',
        ]);

       
        if($request->file('image')){
            if($request->oldImage){
                File::delete($request->oldImage);
            }
            $validator['image'] = $request->file('image')->store('images');
        }

        $article = Article::findOrFail($id);

        $article->update($validator);

        return redirect()->route('article')->with([
            'success' => 'update created successfully'
        ]);
        
    }
 
    public function delete($id)
    {
        $article = Article::findOrFail($id);

        $article->delete();

        return redirect()->route('article')->with([
            'success' => 'Delete created successfully'
        ]);
 
    }
}

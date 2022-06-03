<?php

use App\Http\Controllers\API\ArticleController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);
Route::middleware('auth:api')->group(function () {
    // article
    Route::get('articles', [ArticleController::class, 'index'])->name('article');
    Route::post('articles/create', [ArticleController::class, 'store'])->name('article.store');
    Route::get('articles/show/{id}', [ArticleController::class, 'show'])->name('article.show');
    Route::post('articles/update/{id}', [ArticleController::class, 'update'])->name('article.update');
    Route::delete('articles/delete/{id}', [ArticleController::class, 'delete'])->name('article.delete');
    // category
    Route::get('category', [CategoryController::class, 'index']);
    Route::post('category/create', [CategoryController::class, 'store']);
    Route::get('category/show/{id}', [CategoryController::class, 'show']);
    Route::post('category/update/{id}', [CategoryController::class, 'update']);
    Route::delete('category/delete/{id}', [CategoryController::class, 'delete']);
    
});
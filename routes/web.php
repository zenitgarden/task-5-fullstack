<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware('auth')->group(function () {
    Route::get('/category', [App\Http\Controllers\CategoryController::class, 'index'])->name('category');
    Route::get('/category/create', [App\Http\Controllers\CategoryController::class, 'create'])->name('category.create');
    Route::post('/category/store', [App\Http\Controllers\CategoryController::class, 'store'])->name('category.store');
    Route::get('/category/edit/{id}', [App\Http\Controllers\CategoryController::class, 'edit'])->name('category.edit');
    Route::put('/category/update/{id}', [App\Http\Controllers\CategoryController::class, 'update'])->name('category.update');
    Route::delete('/category/delete/{id}', [App\Http\Controllers\CategoryController::class, 'destroy'])->name('category.delete');

    Route::get('/article', [App\Http\Controllers\ArticleController::class, 'index'])->name('article');
    Route::get('/article/create', [App\Http\Controllers\ArticleController::class, 'create'])->name('article.create');
    Route::post('/article/store', [App\Http\Controllers\ArticleController::class, 'store'])->name('article.store');
    Route::get('/article/show/{id}', [App\Http\Controllers\ArticleController::class, 'show'])->name('article.show');
    Route::get('/article/edit/{id}', [App\Http\Controllers\ArticleController::class, 'edit'])->name('article.edit');
    Route::put('/article/update/{id}', [App\Http\Controllers\ArticleController::class, 'update'])->name('article.update');
    Route::delete('/article/delete/{id}', [App\Http\Controllers\ArticleController::class, 'delete'])->name('article.delete');
});




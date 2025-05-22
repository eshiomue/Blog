<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\BlogCategoryController;
use App\Http\Controllers\BlogController;

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

Route::get('/', [MainController::class, 'welcome'])->name('welcome');
Route::get('/about', [MainController::class, 'aboutUs'])->name('about');
Route::get('/contact', [MainController::class, 'contact'])->name('contact');

Route::get('/add-category', [BlogCategoryController::class, 'create'])->middleware('admin');
Route::post('/add-category', [BlogCategoryController::class, 'save']);
Route::get('/blog-categories', [BlogCategoryController::class, 'getCategories']);
Route::get('/blog-categories/{id}', [BlogCategoryController::class, 'getEditCategoryForm']);
Route::post('/update-category', [BlogCategoryController::class, 'updataBlogCategory']);
Route::get('/delete-category/{id}', [BlogCategoryController::class, 'deleteCategory']);

Route::get('/post/add-post', [BlogController::class, 'getNewPostForm'])->middleware('admin');
Route::post('/post/save', [BlogController::class, 'savePost']);
Route::get('/post/list-post', [BlogController::class, 'ListPost']);
Route::get('/edit-post/{id}', [BlogController::class, 'editPost']);
Route::post('/update-post', [BlogController::class, 'updatePost']);
Route::get('/delete-post/{id}', [BlogController::class, 'deletePost']);
Route::get('/post/view/{id}', [BlogController::class, 'viewPost']);


Route::get('/category/blogs/{id}', [BlogController::class, 'listBlogsInOneCategory']);
Route::post('/posts/comments', [BlogController::class, 'commentPost']);
Route::get('/post/search', [BlogController::class, 'searchPost']);
Route::post('/post/search', [BlogController::class, 'getSearchPostResult']);


 
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\BlogCategoryController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\RedirectController;

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
Route::get('/dashboard', [MainController::class, 'dashboard'])->name('dashboard');

Route::get('/categories', [BlogCategoryController::class, 'getCategories']);
Route::get('/category/{id}/blogs', [BlogController::class, 'listBlogsInOneCategory']);


Route::middleware('auth')->group(function () {
    Route::get('/post/add-post', [BlogController::class, 'getNewPostForm']);
    Route::post('/post/save', [BlogController::class, 'savePost']);
    Route::post('/posts/comments', [BlogController::class, 'commentPost']);
});




Route::prefix('post')
 ->group(function(){
    Route::get('/list-post', [BlogController::class, 'listPost']);
    Route::get('/edit/{id}', [BlogController::class, 'editPost']);
    Route::post('/update', [BlogController::class, 'updatePost']);
    Route::get('/delete/{id}', [BlogController::class, 'deletePost']);
    Route::get('/view/{id}', [BlogController::class, 'viewPost']);
    Route::get('/search', [BlogController::class, 'searchPost']);
    Route::post('/search', [BlogController::class, 'getSearchPostResult']);
    Route::get('delete-ajax/{id}', [BlogController::class, 'deletePostAjax']);
 });


Route::prefix('admin')
 ->middleware(['auth', 'admin'])
 ->group(function(){
    Route::get('/category/add', [AdminController::class, 'create']);
    Route::post('/category/add', [AdminController::class, 'save']);
    Route::get('/category/edit/{id}', [BlogCategoryController::class, 'getEditCategoryForm']);
    Route::post('/category/update', [BlogCategoryController::class, 'updataBlogCategory']);
    Route::get('/category/delete-ajax/{id}', [BlogController::class, 'deleteCategoryAjax']);
    Route::get('/categories/{id}', [BlogCategoryController::class, 'getEditCategoryForm']);
    Route::get('/user/list', [AdminController::class, 'listUsers']);
    Route::get('/deleted/list', [AdminController::class, 'trashedList']);
    Route::get('/restore/{type}/{id}', [AdminController::class, 'restoreFromTrashed']);
    Route::get('/destroy/{type}/{id}', [AdminController::class, 'forceDelete']);
    Route::get('/pending/post', [AdminController::class, 'listPendingPost']);
    Route::get('/rejected/post', [AdminController::class, 'listRejectedPost']);
    Route::post('/post/change-status', [AdminController::class, 'changePostStatus']);
 });

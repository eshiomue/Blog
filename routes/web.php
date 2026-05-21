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

Route::middleware('auth')->group(function () {
    Route::get('/post/add-post', [BlogController::class, 'getNewPostForm']);
    Route::post('/post/save', [BlogController::class, 'savePost']);
    Route::post('/posts/comments', [BlogController::class, 'commentPost']);
});


Route::get('/categories', [BlogCategoryController::class, 'getCategories']);


Route::prefix('post')
 ->group(function(){
    Route::get('/list-post', [BlogController::class, 'listPost']);
    Route::get('/edit/{id}', [BlogController::class, 'editPost']);
    Route::post('/update', [BlogController::class, 'updatePost']);
    Route::get('/delete/{id}', [BlogController::class, 'deletePost']);
    Route::get('/view/{id}', [BlogController::class, 'viewPost']);
    Route::get('/search', [BlogController::class, 'searchPost']);
    Route::post('/search', [BlogController::class, 'getSearchPostResult']);
 });

// Route::get('/post/list-post', [BlogController::class, 'listPost']);
// Route::get('/post/edit/{id}', [BlogController::class, 'editPost']);
// Route::post('/post/update', [BlogController::class, 'updatePost']);
// Route::get('/post/delete/{id}', [BlogController::class, 'deletePost']);
// Route::get('/post/view/{id}', [BlogController::class, 'viewPost']);
// Route::get('/post/search', [BlogController::class, 'searchPost']);
// Route::post('/post/search', [BlogController::class, 'getSearchPostResult']);
Route::get('/category/{id}/blogs', [BlogController::class, 'listBlogsInOneCategory']);


Route::prefix('admin')
 ->middleware(['auth', 'admin'])
 ->group(function(){
    Route::get('/category/add', [AdminController::class, 'create']);
    Route::post('/category/add', [AdminController::class, 'save']);
    Route::post('/category/update', [AdminController::class, 'updataBlogCategory']);
    Route::get('/category/delete/{id}', [AdminController::class, 'deleteCategory']);
    Route::get('/categories/{id}', [BlogCategoryController::class, 'getEditCategoryForm']);
    Route::get('/user/list', [AdminController::class, 'listUsers']);

 });



//redirected user if not login //

// Route::middleware('auth')->group(function () {
//     Route::get('/category/add', [RedirectController::class, 'create']);
//     Route::get('/categories', [RedirectController::class, 'getCategories']);
//     Route::get('/post/list-post', [RedirectController::class, 'ListPost']);
//     Route::get('/post/add-post', [RedirectController::class, 'getNewPostForm']);
//     // Add more admin pages here
// });







// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified'
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogCategory;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class BlogCategoryController extends Controller
{

    public function getCategories(){
        $categories = BlogCategory::withCount('blogs')
            ->orderBy('title', 'DESC')
            ->paginate(20);
            $user = User::where('id', Auth::id())->first();
            if ((!is_null($user)) && ($user->isAdmin())) {
                return view('admin.blog.categories', compact('categories'));
            }
        return view('categories', compact('categories'));
    }

    public function getEditCategoryForm($id){
        $blogCategory = BlogCategory::find($id);
        return view('edit-blog-category', compact('blogCategory'));
    }

    public function updataBlogCategory(Request $req){
        $blogCategory = BlogCategory::find($req['recId']);
        $blogCategory->title = $req->title;
        $blogCategory->description = $req->description;
        $blogCategory->save();
        return redirect()->to('/categories');
    }

    public function deleteCategory($id){
        $blogCategory = BlogCategory::find($id);
        $blogCategory->delete();
        return redirect()->to('/categories');
    }
}

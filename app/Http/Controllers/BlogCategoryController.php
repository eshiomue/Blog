<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogCategory;

class BlogCategoryController extends Controller
{
    public function create(){
        return view('new-category');
    }

    public function save(Request $request){
        $new_blog = new BlogCategory();
        $new_blog->title = $request->title;
        $new_blog->description = $request->description;
        $new_blog->save();
        $notification = array(
            'message' => 'Successfully Created',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function getCategories(){
        $categories = BlogCategory::orderBy('title','DESC')->get();
        return view('blog-categories', compact('categories'));
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
        return redirect()->to('/blog-categories');
    }

    public function deleteCategory($id){
        $blogCategory = BlogCategory::find($id);
        $blogCategory->delete();
        return redirect()->to('/blog-categories');
    }
}

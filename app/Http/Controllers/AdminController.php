<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function getCategories(){
        $categories = BlogCategory::orderBy('title','DESC')->paginate(20);
        return view('admin.categories', compact('categories'));
    }


    public function listBlogsInCategory($id){
        $data = BlogCategory::with('blogs', 'blogs.user')->where('id',$id)->first();
        return view('admin.category-blogs', compact('data'));
    }

    public function create(){
        return view('admin.new-category');
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

    public function listUsers() {
        $users = User::orderBy('user_type')->paginate(10);
        return view('admin.user-list', compact('users'));
    }
}

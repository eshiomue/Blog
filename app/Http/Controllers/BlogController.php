<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogCategory;
use App\Models\Blog;
use Auth;
use App\Models\Comment;

class BlogController extends Controller
{
    
    public function getNewPostForm(){
        $blogCategories = BlogCategory::all();
        return view('blog.new-post', compact('blogCategories'));
    }


    public function savePost(Request $request){
        
        if(isset($request->id)){
            //update
            $blog = Blog::find($request->id);
            $blog->title = $request->title;
            $blog->content = $request->content;
            $blog->posted_by = Auth::id();
            $blog->category_id = $request->category_id;
            $blog->save();
            return redirect()->back()->with('message', 'Blog Updated');
        }else{
            //create
            $photo =    $_FILES['picture']['name'];
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["picture"]["name"]);

            $blog = new Blog();
            $blog->title = $request->title;
            $blog->content = $request->content;
            $blog->posted_by = Auth::id();
            $blog->category_id = $request->category_id;
            $blog->picture = $target_file;
            $blog->save();
            move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file);
            return redirect()->back()->with('message', 'Blog Created');
        }
        

    }
    public function ListPost(){
        $blogs = Blog::with('category', 'comment')->get();
        return view('blog.list-post', compact('blogs'));

    }
    public function editPost($id){
        $blog = Blog::find($id);
        $blogCategories = BlogCategory::all();
        return view('blog.edit-post', compact('blog', 'blogCategories'));
    }

    public function updatePost(Request $req){
        $blog = Blog::find($req['recId']);
        $blog->title = $req->title;
        $blog->content = $req->content;
        $blog->posted_by = $req->posted_by;
        $blog->category_id = $req->category_id;
        $blog->save();
        return redirect()->to('/update-post');

    }

    public function deletePost($id){
        $blog = Blog::find($id);
        $blog->delete();
        return redirect()->to('/post/list-post');

    }
 
    public function viewPost($id){
        $post = Blog::with('comment', 'user', 'comment.user')->where('id',$id)->first();
        if(is_null($post)){
            $notification = array(
                'message' => 'Was not found ',
                'alert-type' => 'error'
            );
            return redirect()->to('/post/list-post')->with($notification);
        }
        return view('blog.view-post', compact('post'));
    }

    public function listBlogsInOneCategory($id){
        $data = BlogCategory::with('blogs', 'blogs.user')->where('id',$id)->first();
        return view('blog.view-category-blogs', compact('data'));
    }

    public function listAllCategoryAndTheirBlogs(){
        $data = BlogCategory::with('blogs')->get();
        dd($data);
    }

    public function commentPost(Request $request){
        $comment = new Comment();
        $comment->comment = $request->comment;
        $comment->user_id = Auth::id();
        $comment->blog_id = $request->id;
        $comment->save();
        return redirect()->back()->with('message', 'Comment saved');
        
    }

    public function searchPost(){
        return view('blog.search_post');

    }


    public function getSearchPostResult(Request $request){
        $search = $request->search;
        $blogs = Blog::where('title','LIKE','%'.$search.'%')->orWhere('content','LIKE','%'.$search.'%')->get();

        return view('blog.search_post', compact('blogs','search'));
    }
}

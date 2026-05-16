<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogCategory;
use App\Models\Blog;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use App\Models\User;
use Exception;

class BlogController extends Controller
{

    public function getNewPostForm(){
        $blogCategories = BlogCategory::all();
         $user = User::where('id', Auth::id())->first();
        if ((!is_null($user)) && ($user->isAdmin())) {
            return view('admin.blog.new-post', compact('blogCategories'));
        }
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
        try {
            $blogs = Blog::with('category', 'comments')->paginate(2);
            $user = User::where('id', Auth::id())->first();
            if ((!is_null($user)) && ($user->isAdmin())) {
                return view('admin.blog.list-post', compact('blogs'));
            }
            return view('blog.list-post', compact('blogs'));
        } catch(Exception $ex) {
            logger($ex);
            return redirect()->back()->with('error', $ex->getMessage());
        }

    }
    public function editPost($id){
        $blog = Blog::find($id);
        $blogCategories = BlogCategory::all();
        $user = User::where('id', Auth::id())->first();
        if ((!is_null($user)) && ($user->isAdmin())) {
            return view('admin.blog.edit-post', compact('blog', 'blogCategories'));
        }
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
        $post = Blog::with('comments', 'user', 'comments.user')->where('id',$id)->first();
        if(is_null($post)){
            $notification = array(
                'message' => 'Was not found ',
                'alert-type' => 'error'
            );
            return redirect()->to('/post/list-post')->with($notification);
        }
        $relatedPosts = Blog::with('user', 'category')
            ->whereHas('category', function($q) use($id) {
                $q->where('id', $id);
            })->orderBy('id','DESC')->get()->take(10);
        
        $categories = BlogCategory::all();
        $user = User::where('id', Auth::id())->first();
        if ((!is_null($user)) && ($user->isAdmin())) {
            return view('admin.blog.view-post', compact('post', 'relatedPosts', 'categories'));
        }
        return view('blog.view-post', compact('post', 'relatedPosts', 'categories'));
    }

    public function listBlogsInOneCategory($id){
        $data = BlogCategory::with('blogs', 'blogs.user')->where('id',$id)->first();
        $categories =  BlogCategory::paginate(20);
        $user = User::where('id', Auth::id())->first();
        if ((!is_null($user)) && ($user->isAdmin())) {
            return view('admin.blog.view-category-blogs', compact('data', 'categories'));
        }
        return view('blog.view-category-blogs', compact('data', 'categories'));
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

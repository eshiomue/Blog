<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogCategory;
use App\Models\Blog;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use App\Models\User;
use Exception;
use Mews\Purifier\Facades\Purifier;

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
        try{
            if(isset($request->id)){
                //update
                $blog = Blog::find($request->id);
                $blog->title = $request->title;
                $blog->content = Purifier::clean($request->content);
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
                $blog->content = Purifier::clean($request->content);
                $blog->posted_by = Auth::id();
                $blog->category_id = $request->category_id;
                $blog->picture = $target_file;
                $blog->save();
                move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file);
                return redirect()->back()->with('message', 'Blog Created');
            }
         } catch(Exception $ex) {
            logger($ex);
            return redirect()->back()->with('error', $ex->getMessage());
        }

    }
    public function listPost(){
        $myPost = null;
        $blogs = null;
        try {
            $user = User::where('id', Auth::id())->first();
            if ((!is_null($user)) && ($user->isAdmin())) {
                $blogs = Blog::with('category', 'comments')
                    ->orderBy('created_at', 'DESC')
                    ->where('status', 'active')
                    ->paginate(6);
                return view('admin.blog.list-post', compact('blogs'));
            }
            if(Auth::check()){
                $myPost = Blog::with('category', 'comments')
                    ->where('posted_by', Auth::id())
                    ->orderBy('created_at', 'DESC')->paginate(6);
                $blogs = Blog::with('category', 'comments')
                    ->where('posted_by', '<>', Auth::id())
                    ->where('status', 'active')
                    ->orderBy('created_at', 'DESC')->paginate(6);
            } else {
                $blogs = Blog::with('category', 'comments')
                    ->where('status', 'active')
                    ->orderBy('created_at', 'DESC')
                    ->paginate(6);
            }

            $categories = BlogCategory::paginate(20);
            return view('blog.list-post', compact('blogs', 'categories', 'myPost'));
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
        logger('updatePost');
        try{
            if(is_null($req->blogId)) {
                return redirect()->back()->with('error', 'No post selected');
            }
            $blog = Blog::find($req->blogId);
            if(is_null($blog)) {
                return redirect()->back()->with('error', 'Post not found');
            }
            $imagePath = '';
            $oldAvatar = $blog->picture;
            if ($req->file('picture')) {
                logger('Replacing picture');
                $target_dir = "uploads/";
                $imagePath = $target_dir . basename($_FILES["picture"]["name"]);
                move_uploaded_file($_FILES["picture"]["tmp_name"], $imagePath);
                logger('Unlink old picture ' . $oldAvatar);
                unlink($oldAvatar);
            }

            $blog->title = $req->title;
            $blog->content = Purifier::clean($req->content);
            $blog->category_id = $req->category_id;
            $blog->picture = $imagePath != '' ? $imagePath : $oldAvatar;
            $blog->save();
            return redirect()->back()->with('success', 'Post updated successfully');
        }catch(Exception $ex) {
            logger('Error=>' . $ex);
            return redirect()->back()->with('error', $ex->getMessage());
        }


    }

    public function deletePost($id){
        try {
            $blog = Blog::find($id);
            $blog->delete();
            return redirect()->to('/post/list-post');
         } catch(Exception $ex) {
            logger($ex);
            return redirect()->back()->with('error', $ex->getMessage());
        }

    }

    public function viewPost($id){
        $keyword = request('search');
        $post = Blog::with('comments', 'user', 'comments.user')->where('id',$id)->first();
        if(is_null($post)){
            $notification = array(
                'message' => 'Was not found ',
                'alert-type' => 'error'
            );
            return redirect()->to('/post/list-post')->with($notification);
        }
        $relatedPosts = Blog::with('user', 'category')
            ->whereHas('category', function($q) use($post) {
                $q->where('id', $post->category_id);
            })
            ->where('id', '<>', $id)->orderBy('id','DESC')
            ->where('status', 'active')
            ->get()->take(10);

        $categories = BlogCategory::all();
        $user = User::where('id', Auth::id())->first();
        if ((!is_null($user)) && ($user->isAdmin())) {
            return view('admin.blog.view-post', compact('post', 'relatedPosts', 'categories', 'keyword'));
        }
        return view('blog.view-post', compact('post', 'relatedPosts', 'categories', 'keyword'));
    }

    public function listBlogsInOneCategory($id){
        $category = BlogCategory::find($id);
        if(is_null($category)) {
            return redirect()->back()->with('error', 'Category not found');
        }
        $blogs = Blog::with('category', 'user')
        ->where('status', 'active')
        ->where('category_id',$id)->paginate(12);
        $categories =  BlogCategory::paginate(20);
        $user = User::where('id', Auth::id())->first();

        $data = array('title'=> $category->title . ' blogs', 'blogs'=>$blogs, 'id'=>$id);
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
        if (Auth::check()) {
            $user = User::where('id', Auth::id())->first();
            if ((!is_null($user)) && ($user->isAdmin())) {
                return view('admin.blog.search_post');
            }
        }
        return view('blog.search_post');

    }


    public function getSearchPostResult(Request $request){
        $search = $request->search;
        $blogs = Blog::where('title','LIKE','%'.$search.'%')
            ->orWhere('content','LIKE','%'.$search.'%')
            ->where('status', 'active')
            ->get();
         if (Auth::check()) {
            $user = User::where('id', Auth::id())->first();
            if ((!is_null($user)) && ($user->isAdmin())) {
                return view('admin.blog.search_post', compact('blogs','search'));
            }
        }
        return view('blog.search_post', compact('blogs','search'));
    }

    public function deletePostAjax ($id) {
        logger('Delete post with id ' . $id);
        $res = array('isSuccess'=>false, 'code'=>500, 'Message'=>'Request processing error');
        if (!Auth::check()) {
            logger('User is not logged in');
            $res = array('isSuccess'=>false, 'code'=>403, 'Message'=>'You must login to perform this action');
            return response()->json($res);
        }

        if ((is_null($id)) || ($id == '')) {
            logger('Invalid post id ');
            $res = array('isSuccess'=>false, 'code'=>500, 'Message'=>'Post id is required');
            return response()->json($res);
        }

        $post = Blog::find($id);

        if (is_null($post)) {
            logger('Post not found ');
            $res = array('isSuccess'=>false, 'code'=>500, 'Message'=>'not found');
            return response()->json($res);
        }

        $post->delete();
        logger('Post deleted successfully');
        $res = array('isSuccess'=>true, 'code'=>200, 'Message'=>'Post deleted successfully');
        return response()->json($res);

    }

    public function deleteCategoryAjax ($id) {
        logger('Delete category with id ' . $id);
        $res = array('isSuccess'=>false, 'code'=>500, 'Message'=>'Request processing error');
        if (!Auth::check()) {
            logger('User is not logged in');
            $res = array('isSuccess'=>false, 'code'=>403, 'Message'=>'You must login to perform this action');
            return response()->json($res);
        }

        if ((is_null($id)) || ($id == '')) {
            logger('Invalid category id ');
            $res = array('isSuccess'=>false, 'code'=>500, 'Message'=>'Category id is required');
            return response()->json($res);
        }

        $category = BlogCategory::find($id);

        if (is_null($category)) {
            logger('Category not found ');
            $res = array('isSuccess'=>false, 'code'=>500, 'Message'=>'not found');
            return response()->json($res);
        }

        $category->delete();
        logger('Category deleted successfully');
        $res = array('isSuccess'=>true, 'code'=>200, 'Message'=>'Post deleted successfully');
        return response()->json($res);
    }
}

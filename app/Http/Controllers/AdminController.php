<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function getCategories(){
        $categories = BlogCategory::orderBy('title','DESC')->paginate(12);
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

    public function trashedList() {
        $trashedPosts = Blog::where('deleted_at', '!=', null)->withTrashed()->get()->take(20);
        $trashedUsers = User::where('deleted_at', '!=', null)->withTrashed()->get()->take(20);
        $trashedCategories = BlogCategory::where('deleted_at', '!=', null)->withTrashed()->get()->take(20);

        $data = array('trashedPosts' => $trashedPosts, 'trashedUsers' => $trashedUsers, 'trashedCategories' => $trashedCategories);
        return view('admin.trashed-list', compact('data'));

    }

    public function restoreFromTrashed($type, $id) {
        logger('restoreFromTrashed ' . $type . ' - ' . $id);
        $message = 'Request processing error';
        try {
            if ((is_null($type)) || ($id == null)) {
                logger('Bad request');
                return redirect()->back()->with('error', 'Category and id required');
            }
            if (strtolower($type) == 'category') {
                $cat = BlogCategory::withTrashed()->where('id', $id)->first();
                if (!is_null($cat)) {
                    logger('restoring category');
                    $cat->restore();
                }
            } else if (strtolower($type) == 'post') {
                $blog = Blog::withTrashed()->where('id', $id)->first();
                logger('post ' . $blog);
                if (!is_null($blog)) {
                    logger('restoring post');
                    $blog->restore();
                }
            }else if (strtolower($type) == 'user') {
                $user = User::withTrashed()->where('id', $id)->first();
                if (!is_null($user)) {
                    logger('restoring user');
                    $user->restore();
                }
            }

            return redirect()->back()->with('success', 'Record restored');

        } catch (Exception $ex) {
            logger($ex);
            return redirect()->back()->with('error', $message);
        }

    }


    public function forceDelete($type, $id) {
        logger('forceDelete ' . $type . ' - ' . $id);
        $message = 'Request processing error';
        try {
            if ((is_null($type)) || ($id == null)) {
                return redirect()->back()->with('error', 'Category and id required');
            }
            if (strtolower($type) == 'category') {
                $cat = BlogCategory::withTrashed()->where('id', $id)->first();
                if (!is_null($cat)) {
                    $cat->forceDelete();
                }
            } else if (strtolower($type) == 'post') {
                $blog = Blog::withTrashed()->where('id', $id)->first();
                if (!is_null($blog)) {
                    $blog->forceDelete();
                }
            }else if (strtolower($type) == 'user') {
                $user = User::withTrashed()->where('id', $id)->first();
                if (!is_null($user)) {
                    $user->forceDelete();
                }
            }

            return redirect()->back()->with('success', 'Record destroyed');

        } catch (Exception $ex) {
            logger($ex);
            return redirect()->back()->with('error', $message);
        }
    }


    public function listPendingPost () {
        $blogs = Blog::with('category', 'user')->where('status', 'pending')->paginate(20);
        return view ('admin.blog.pending-post', compact('blogs'));
    }

    public function listRejectedPost () {
        $blogs = Blog::with('category', 'user')->where('status', 'rejected')->paginate(20);
        return view ('admin.blog.rejected-post', compact('blogs'));
    }

    public function changePostStatus (Request $request) {
        logger('changePostStatus ' . json_encode($request));

        $res = array('isSuccess'=>false, 'code'=>500, 'message'=>'Request processing error');
        try {
            if (!Auth::check()) {
                logger('User is not logged in');
                $res = array('isSuccess'=>false, 'code'=>403, 'message'=>'You must login to perform this action');
                return response()->json($res);
            }
            $user = User::where('id', Auth::id())->first();
            if ((is_null($user)) || (!$user->isAdmin())) {
                logger('User is not an admin');
                $res = array('isSuccess'=>false, 'code'=>403, 'message'=>'You must be an admin to perform this action');
                return response()->json($res);
            }

            $post = Blog::where('id', $request->postId)->first();
            if (is_null($post)) {
                logger('Post not found');
                $res = array('isSuccess'=>false, 'code'=>404, 'message'=>'Post not found');
                return response()->json($res);
            }
            $post->status = $request->status;
            $post->save();
            $res = array('isSuccess'=>true, 'code'=>200, 'message'=>'Successful');
            return response()->json($res);
        } catch (Exception $ex) {
            logger($ex);
            $res = array('isSuccess'=>false, 'code'=>500, 'message'=>$ex->getMessage());
            return response()->json($res);
        }

    }
}

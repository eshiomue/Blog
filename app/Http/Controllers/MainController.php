<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Comment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function welcome(){
        $posts = Blog::with('user', 'category')->orderBy('title')->paginate(12);
        $categories = BlogCategory::paginate(12);
        return view('welcome', compact('posts', 'categories'));
    }

    public function aboutUs(){
        $name = "Prosper";
        return view('about',compact('name'));
    }
     public function contact(){
        return view('contact');
    }

    public function dashboard(){
        $user = User::where('id', Auth::id())->first();
        if (is_null($user)) {
            return redirect()->back()->with('error', 'You must be logged in to access this page');
        }
        if ((!is_null($user)) && ($user->isAdmin())) {
            logger('Admin user');
            $catgories = BlogCategory::count();
            $posts = Blog::count();
            $users = User::count();
            $compaints = 0;
            $last7DaysPostCount = Blog::where('created_at', '>=', Carbon::now()->subWeek())->count();
            $last7DaysCategoryCount = BlogCategory::where('created_at', '>=', Carbon::now()->subWeek())->count();
            $last7DaysUserCount = User::where('created_at', '>=', Carbon::now()->subWeek())->count();
            $last7DaysTagCount = 0;
            $recent = Blog::orderBy('created_at', 'DESC')->get()->take(3);
            $recentSignups = User::orderBy('created_at', 'DESC')->get()->take(5);
            return view('admin.dashboard',
                compact('catgories', 'posts', 'users', 'compaints', 'last7DaysPostCount',
                'last7DaysCategoryCount', 'last7DaysUserCount', 'last7DaysTagCount', 'recent', 'recentSignups'));
        } else {
            logger('non-admin user');
            $myPosts = Blog::with('comments', 'category')->where('posted_by', $user->id)->paginate(5);
            $myComments = Comment::with('post')->where('user_id', $user->id)->paginate(5);
            $latestPosts = Blog::orderBy('created_at', 'DESC')->paginate(12);
            $categories = BlogCategory::paginate(10);
            $profile = Auth::user();
            return view('dashboard', compact('myPosts', 'myComments', 'latestPosts', 'categories', 'profile'));
        }
    }

}

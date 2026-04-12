<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use Auth;

class MainController extends Controller
{
    public function welcome(){
        return view('welcome');
    }

    public function aboutUs(){
        $name = "Prosper";
        return view('about',compact('name'));
    }
     public function contact(){
        return view('contact');
    }

    public function dashboard(){
        $blogs = Blog::orderBy('title','contant')->get();
        return view('dashboard', compact('blog'));
    }

}

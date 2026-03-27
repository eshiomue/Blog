<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RedirectController extends Controller
{
    // Show the Add Category page
    public function create()
    {
        return view('add-category'); 
    }

     public function getCategories()
    {
        return view('blog-categories'); 
    }

     public function getNewPostForm()
    {
        return view('post/add-post'); 
    }
     public function ListPost()
    {
        return view('post/list-post'); 
    }
}

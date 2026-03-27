<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

}

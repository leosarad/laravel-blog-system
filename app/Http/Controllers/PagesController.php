<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Post;


class PagesController extends Controller
{
    public function index(){
        return view('posts.index');
    }
    public function dashboard(){
        return view('dashboard');
    }
    public function test(){
        $posts = Post::get();
        return view('test')->with('posts',$posts);
    }
}

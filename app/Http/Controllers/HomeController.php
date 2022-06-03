<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Profile;
use Hash;
use App\Post;
use App\Tag;
use App\Comment;
use App\Category;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::latest()->paginate(10); 
        $all_users = User::all(); 
        $posts = Post::all(); 
        $category = Category::all(); 
        $tags = Tag::all();  
        
        return view("home")->with('users', $users)->with('all_users', $all_users)->with('posts', $posts)->with('category', $category)->with('tags', $tags); 
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

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
        $categories = Category::orderBy('id', 'DESC')->limit('3')->get();
        $posts = Post::orderBy('id', 'DESC')->where('post_type', 'post')->limit('3')->get();
        $pages = Post::orderBy('id', 'DESC')->where('post_type', 'pages')->limit('3')->get();
        return view('admin.index', compact('categories', 'posts', 'pages'));
    }
}

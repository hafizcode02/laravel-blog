<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'DESC')->where('post_type', 'post')->paginate(10);
        return view('admin.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('name', 'ASC')->pluck('name', 'id');
        return view('admin.post.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                "thumbnail" => 'required',
                "title" => 'required|unique:posts',
                "details" => "required",
                "category_id" => "required"
            ],
            [
                'thumbnail.required' => 'Enter thumbnail url',
                'title.required' => 'Enter title',
                'title.unique' => 'Title already exist',
                'details.required' => 'Enter details',
                'category_id.required' => 'Select categories',
            ]
        );

        // DB::enableQueryLog();
        Post::updateOrCreate([
            'user_id' => Auth::id(),
            'thumbnail' => $request->thumbnail,
            'title' => $request->title,
            'slug' => str_slug($request->title),
            'sub_title' => $request->sub_title,
            'details' => $request->details,
            'is_published' => $request->is_published,
            'post_type' => 'post'
        ])->categories()->sync($request->category_id, false);
        // dd(DB::getQueryLog());

        session()->flash('message', 'Post Created Successfully');
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::orderBy('name', 'ASC')->pluck('name', 'id');
        return view('admin.post.edit', compact('categories', 'post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->validate(
            $request,
            [
                "thumbnail" => 'required',
                "title" => 'required|unique:posts,title,' . $post->id,
                "details" => "required",
                "category_id" => "required"
            ],
            [
                'thumbnail.required' => 'Enter thumbnail url',
                'title.required' => 'Enter title',
                'title.unique' => 'Title already exist',
                'details.required' => 'Enter details',
                'category_id.required' => 'Select categories',
            ]
        );


        // DB::enableQueryLog();
        Post::updateOrCreate(['id' => $post->id], [
            'user_id' => Auth::id(),
            'thumbnail' => $request->thumbnail,
            'title' => $request->title,
            'slug' => str_slug($request->title),
            'sub_title' => $request->sub_title,
            'details' => $request->details,
            'is_published' => $request->is_published,
            'post_type' => 'post'
        ])->categories()->sync($request->category_id, false);
        // dd(DB::getQueryLog());

        session()->flash('message', 'Post Created Successfully');
        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        session()->flash('del-message', 'Post Deleted Successfully');
        return redirect()->route('posts.index');
    }
}

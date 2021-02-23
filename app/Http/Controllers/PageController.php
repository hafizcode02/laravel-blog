<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Post::orderBy('id', 'DESC')->where('post_type', 'page')->paginate(10);
        return view('admin.page.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.page.create');
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
            ],
            [
                'thumbnail.required' => 'Enter thumbnail url',
                'title.required' => 'Enter title',
                'title.unique' => 'Title already exist',
                'details.required' => 'Enter details',
            ]
        );

        Post::updateOrCreate([
            'user_id' => Auth::id(),
            'thumbnail' => $request->thumbnail,
            'title' => $request->title,
            'slug' => str_slug($request->title),
            'sub_title' => $request->sub_title,
            'details' => $request->details,
            'is_published' => $request->is_published,
            'post_type' => 'page'
        ]);

        session()->flash('message', 'Page Created Successfully');
        return redirect()->route('pages.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = Post::findOrFail($id);
        return view('admin.page.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                "thumbnail" => 'required',
                "title" => 'required|unique:posts,title,' . $id,
                "details" => "required",
            ],
            [
                'thumbnail.required' => 'Enter thumbnail url',
                'title.required' => 'Enter title',
                'title.unique' => 'Title already exist',
                'details.required' => 'Enter details',
            ]
        );

        Post::updateOrCreate(['id' => $id], [
            'user_id' => Auth::id(),
            'thumbnail' => $request->thumbnail,
            'title' => $request->title,
            'slug' => str_slug($request->title),
            'sub_title' => $request->sub_title,
            'details' => $request->details,
            'is_published' => $request->is_published,
            'post_type' => 'page'
        ]);

        session()->flash('message', 'Page Created Successfully');
        return redirect()->route('pages.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page = Post::findOrFail($id);
        $page->delete();

        session()->flash('del-message', 'Post Deleted Successfully');
        return redirect()->route('pages.index');
    }
}

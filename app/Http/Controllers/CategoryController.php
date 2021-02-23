<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get data from table categories
        $categories = Category::orderBy('id', 'DESC')->get();
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate user input
        $this->validate(
            $request,
            [
                'thumbnail' => 'required',
                'name' => 'required|unique:categories'
            ],
            // custom error message of unvalidate input
            [
                'thumbnail.required' => 'Enter Thumbnail URL',
                'name.required' => 'Enter Name',
                'name.unique' => 'Category already exists'
            ]
        );

        // insert data
        Category::updateOrCreate([
            'user_id' => Auth::id(),
            'thumbnail' => $request->thumbnail,
            'name' => $request->name,
            'slug' => str_slug($request->name),
            'is_published' => $request->is_published
        ]);

        // set flash message and redirect
        session()->flash('message', 'Category created successfully');
        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        // redirect to edit page and send data to this page from category, automatic because we use artisan -mcr before.
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        // validate input
        $this->validate(
            $request,
            [
                'thumbnail' => 'required',
                'name' => 'required|unique:categories,name,' . $category->id
            ],
            // custom error message
            [
                'thumbnail.required' => 'Enter Thumbnail URL',
                'name.required' => 'Enter Name',
                'name.unique' => 'Category already exists'
            ]
        );

        //update data
        Category::updateOrCreate(
            [
                'id' => $category->id
            ],
            [
                'user_id' => Auth::id(),
                'thumbnail' => $request->thumbnail,
                'name' => $request->name,
                'slug' => str_slug($request->name),
                'is_published' => $request->is_published
            ]
        );

        // set flash message and redirect
        session()->flash('message', 'Category updated successfully');
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        // delete record
        $category->delete();

        // set flash messsage and redirect
        session()->flash('del-message', 'Category Deleted Successfully');
        return redirect()->route('categories.index');
    }
}

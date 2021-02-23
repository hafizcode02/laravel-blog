<?php

namespace App\Http\Controllers;

use App\Models\Galery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GaleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $galeries = Galery::orderBy('id', 'DESC')->paginate(5);
        return view('admin.gallery.index', compact('galeries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.gallery.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'image_url' => 'required',
        ], [
            'image_url.required' => 'Select Image'
        ]);

        foreach ($request->image_url as $image_url) {
            // Get file name with extension
            $fileNameWithExt = $image_url->getClientOriginalName();

            // Get just file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            // Get just file extension
            $fileExt = $image_url->getClientOriginalExtension();

            // Get file name to store
            $fileNameToStore = $fileName . '.' . $fileExt;

            $todoInsert = Galery::updateOrCreate([
                'user_id' => Auth::id(),
                'image_url' => $fileNameToStore,
            ]);

            if ($todoInsert) {
                $image_url->storeAs('public/galleries', $fileNameToStore);
            }
        }

        session()->flash('message', 'Image uploaded successfuly');
        return redirect()->route('galeries.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Galery  $galery
     * @return \Illuminate\Http\Response
     */
    public function show(Galery $galery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Galery  $galery
     * @return \Illuminate\Http\Response
     */
    public function edit(Galery $galery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Galery  $galery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Galery $galery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Galery  $galery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Galery $galery)
    {
        Storage::delete('public/galleries/' . $galery->image_url);
        $galery->delete();

        session()->flash('del-message', 'Image Deleted Successfully');
        return redirect()->route('galeries.index');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;

class AlbumController extends Controller
{
    public function __construct()
    {
      $this->middleware(['auth','role:superadmin']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $album = Album::with('photos')->get();
        return view('backend.gallery.album.index',compact('album'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.gallery.album.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
          'name' => 'required', 'cover' => 'required|image'
        ];

        $validator = Validator::make(request()->all(), $rules);

        if($validator->fails()) {
          return redirect()->route('albums.create')->withErrors($validator)->withInput();
        }

        $file = Input::file('cover');
        $random_name = str_random(8);
        $destinationPath = 'gallery/albums/';
        $extension = $file->getClientOriginalExtension();
        $filename=$random_name.'_cover.'.$extension;
        $uploadSuccess = Input::file('cover')->move($destinationPath, $filename);
        $album = Album::create([
          'name' => $request->name,
          'description' => $request->description,
          'cover' => $filename,
        ]);

        return redirect()->route('albums.show',$album->album_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $album = Album::with('Photos')->find($id);
        return view('backend.gallery.album.show',compact('album'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function edit(Album $album)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Album $album)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //$del = Album::destroy($id);
        $del = Album::find($id);
        $file = public_path().'/gallery/albums/'.$del->cover;
        \File::delete($file);
        $del->delete();
        return redirect()->route('albums.index');
    }
}

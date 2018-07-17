<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $album = Album::find($id);
        return view('backend.gallery.photo.create',compact('album'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
      $data = $id;

      $rules = [
        'image'=>'required|image'
      ];

      $validator = Validator::make(request()->all(), $rules);

      if($validator->fails()){
        return Redirect::route('photos.create',$data)
        ->withErrors($validator)
        ->withInput();
      }

      $file = Input::file('image');
      $random_name = str_random(8);
      $destinationPath = 'gallery/photos/';
      $extension = $file->getClientOriginalExtension();
      $filename=$random_name.'_album_image.'.$extension;
      $uploadSuccess = Input::file('image')->move($destinationPath, $filename);
      Photo::create([
        'description' => $request->description,
        'image' => $filename,
        'album_id'=> $data
      ]);

      return redirect()->route('albums.show',$data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function show(Photo $photo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function edit(Photo $photo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Photo $photo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function destroy($a_id, $id)
    {
        $data = $a_id;
        $del = Photo::find($id);
        $file = public_path().'/gallery/photos/'.$del->image;
        \File::delete($file);
        $del->delete();
        return redirect()->route('albums.show',$data);
    }
}

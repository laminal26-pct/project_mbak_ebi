<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;

class VideoController extends Controller
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
      $video = Video::all();
      return view('backend.video.index', compact('video'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.video.create');
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
          'title' => 'required', 'filevideo' => 'max:100040|required', 'status' => 'required'
        ];

        $check = Video::where('status','Aktif')->get()->count();
        if ($check == 1) {
          $status = "NonAktif";
        } else {
          $status = $request->post_status;
        }
        $file = Input::file('filevideo');
        $random_name = str_random(16);
        $destinationPath = 'video/';
        $extension = $file->getClientOriginalExtension();
        $filename = $random_name.'_video.'.$extension;
        $uploadSuccess = Input::file('filevideo')->move($destinationPath,$filename);
        $video = Video::create([
          'title' => $request->title,
          'videos' => $filename,
          'slug' => str_slug(sha1($request->title),'-'),
          'status' => $status
        ]);
        return redirect()->route('video.show',$video->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $video = Video::where('slug',$slug)->first();
        return view('backend.video.show', compact('video'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $video = Video::where('slug',$slug)->first();
        return view('backend.video.edit',compact('video'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
      $rules = [
        'title' => 'required', 'status' => 'required'
      ];

      $validator = Validator::make(request()->all(), $rules);

      if ($validator->fails()) {
        return redirect()->route('video.edit',$slug)->withErrors($validator)->withInput();
      }
      $check = Video::where('status','Aktif')->get()->count();
      if ($check == 1) {
        $status = "NonAktif";
      } else {
        $status = $request->status;
      }
      $video = Video::where('slug',$slug)->first();
      $video->update([
        'title' => $request->title,
        'slug' => str_slug(sha1($request->title),'-'),
        'status' => $status
      ]);
      return redirect()->route('video.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $del = Video::where('slug',$slug)->first();
        $file = public_path().'/video/'.$del->videos;
        \File::delete($file);
        $del->delete();
        return redirect()->route('video.index');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Relawan;
use Illuminate\Http\Request;
use Session, Validator, Input;

class RelawanController extends Controller
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
        $relawan = Relawan::all();
        return view('backend.relawan.index', compact('relawan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.relawan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(request()->all(), [
          'nama' => 'required', 'fupload' => 'required', 'post_status' => 'required', 'alamat' => 'required'
        ]);

        if($validator->fails()) {
          Session::flash("flash_notification", [
            "level"   => "danger",
            "message" => "Please... field is required",
          ]);
          return redirect()->back()->withErrors($validator->errors());
        }

        ($request->fupload == null) ? $img = 'assets/pages/img/people/img5-small.jpg' : $img = $request->fupload;
        Relawan::create([
          'nama' => $request->nama,
          'images' => $img,
          'slug' => str_slug(sha1($request->nama),'-'),
          'status' => $request->post_status,
          'alamat' => $request->alamat
        ]);
        Session::flash("flash_notification", [
          "level"   => "success",
          "message" => "Relawan Berhasil Disimpan"
        ]);
        return redirect()->route('info-relawan.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Relawan  $relawan
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $relawan = Relawan::where('slug',$slug)->first();
        return view('backend.relawan.show',compact('relawan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Relawan  $relawan
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $relawan = Relawan::where('slug',$slug)->first();
        return view('backend.relawan.edit',compact('relawan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Relawan  $relawan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
      $validator = Validator::make(request()->all(), [
        'nama' => 'required', 'images' => 'required', 'status' => 'required', 'alamat' => 'required'
      ]);

      if($validator->fails()) {
        Session::flash("flash_notification", [
          "level"   => "danger",
          "message" => "Please... field is required",
        ]);
        return redirect()->back()->withErrors($validator->errors());
      }

      ($request->images == null) ? $img = 'assets/pages/img/people/img5-small.jpg' : $img = $request->images;
      $relawan = Relawan::where('slug',$slug)->first();
      $relawan->update([
        'nama' => $request->nama,
        'images' => $img,
        'slug' => str_slug(sha1($request->nama),'-'),
        'status' => $request->status,
        'alamat' => $request->alamat
      ]);
      Session::flash("flash_notification", [
        "level"   => "success",
        "message" => "Relawan Berhasil Diubah"
      ]);
      return redirect()->route('info-relawan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Relawan  $relawan
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $relawan = Relawan::where('slug',$slug)->first();
        $file = public_path().$relawan->images;
        \File::delete($file);
        $relawan->delete();
        return redirect()->route('info-relawan.index');
    }
}

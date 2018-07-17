<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Website;
use Session, Validator;

class WebsiteController extends Controller
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
        $web = Website::all();
        return view('backend.website.index',compact('web'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.website.create');
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
          'nama_web' => 'required',
          'tipe' => 'required',
          'description' => 'required'
        ]);

        if($validator->fails()) {
          Session::flash("flash_notification", [
            "level"   => "danger",
            "message" => "Field Harus Diisi"
          ]);
          return redirect()->back()->withErrors($validator->fails());
        }

        Website::create([
          'nama_web' => $request->nama_web,
          'kategori_website' => $request->tipe,
          'description' => $request->description
        ]);
        Session::flash("flash_notification", [
          "level"   => "success",
          "message" => "Berhasil Disimpan"
        ]);
        return redirect()->route('konfig-web.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $web = Website::find($id);
      return view('backend.website.show',compact('web'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $web = Website::find($id);
      return view('backend.website.edit',compact('web'));
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
      $validator = Validator::make(request()->all(), [
        'nama_web' => 'required',
        'description' => 'required'
      ]);

      if($validator->fails()) {
        Session::flash("flash_notification", [
          "level"   => "danger",
          "message" => "Field Harus Diisi"
        ]);
        return redirect()->back()->withErrors($validator->fails());
      }
      $web = Website::find($id);
      $web->update([
        'nama_web' => $request->nama_web,
        'description' => $request->description
      ]);
      Session::flash("flash_notification", [
        "level"   => "success",
        "message" => "Berhasil Diubah"
      ]);
      return redirect()->route('konfig-web.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

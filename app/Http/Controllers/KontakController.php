<?php

namespace App\Http\Controllers;

use App\Models\Kontak;
use App\Models\Relawan;
use Illuminate\Http\Request;
use Validator, Session;

class KontakController extends Controller
{
    protected function relawan()
    {
      $relawan = Relawan::where('status','Aktif')->get();
      return $relawan;
    }

    public function relawanShow($slug) {
      $relawan = Relawan::select('nama','images','status','alamat', 'join')->where('slug',$slug)->first();
      if ($relawan) {
        return response()->json($relawan, 201);
      }
      return response()->json(['message' => 'Not avaiable'],404);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $kontak = Kontak::all();
      return view('backend.kontak.index',compact('kontak'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $relawan = $this->relawan();
        return view('frontend.kontak', compact('relawan'));
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
          'nama' => 'required',
          'email' => 'required|email',
          'telepon' => 'required',
          'alamat' => 'required',
          'pesan' => 'required'
        ]);
        if ($validator->fails()) {
          Session::flash("flash_notification", [
            "level"   => "danger",
            "message" => "Please... field is required",
          ]);
          return redirect()->back()->withErrors($validator->errors());
        }
        Kontak::create([
          'nama' => $request->nama,
          'email' => $request->email,
          'telepon' => $request->telepon,
          'alamat' => $request->alamat,
          'pesan' => $request->pesan
        ]);
        Session::flash("flash_notification", [
          "level"   => "success",
          "message" => "Info mu telah dikirim ke bagian Admin"
        ]);
        return redirect()->route('home.kontak.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kontak  $kontak
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kontak = Kontak::find($id);
        $kontak->update([
          'read' => 1
        ]);
        return view('backend.kontak.show',compact('kontak'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kontak  $kontak
     * @return \Illuminate\Http\Response
     */
    public function edit(Kontak $kontak)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kontak  $kontak
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kontak $kontak)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kontak  $kontak
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Kontak::destroy($id);
        Session::flash("flash_notification", [
          "level"   => "success",
          "message" => "Berhasil dihapus"
        ]);
        return redirect()->route('kontak.index');
    }
}

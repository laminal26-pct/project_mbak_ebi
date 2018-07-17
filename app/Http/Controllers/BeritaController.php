<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use App\Models\KategoriBerita;
use App\Models\User;
use Validator, Session, Auth;

class BeritaController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      if (Auth::user()->hasRole('superadmin')) {
        $news = Berita::select('users.name','users.user_id','kategori_beritas.nama_kategori_berita','kategori_beritas.kategori_berita_id','beritas.*')
                ->join('kategori_beritas','kategori_beritas.kategori_berita_id','beritas.kategori_berita_id')
                ->join('users','users.user_id','beritas.user_id')
                ->orderBy('created_at','desc')
                ->get();
      } else {
        $news = Berita::select('users.email','users.name','users.user_id','kategori_beritas.nama_kategori_berita','kategori_beritas.kategori_berita_id','beritas.*')
                ->join('kategori_beritas','kategori_beritas.kategori_berita_id','beritas.kategori_berita_id')
                ->join('users','users.user_id','beritas.user_id')
                ->where('users.email',Auth::user()->email)
                ->orderBy('created_at','desc')
                ->get();
      }
      return view('backend.berita.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $kategori = KategoriBerita::all();
      return view('backend.berita.create',compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      if (Auth::user()->hasRole('superadmin')) {
        $validator = Validator::make(request()->all(), [
          'title' => 'required', 'headline' => 'required', 'post_status' => 'required', 'description' => 'required'
        ]);
      } else {
        $validator = Validator::make(request()->all(), [
          'title' => 'required', 'description' => 'required'
        ]);
      }
      if($validator->fails()) {
        Session::flash("flash_notification", [
          "level"   => "danger",
          "message" => "Please... field is required",
        ]);
        return redirect()->back()->withErrors($validator->errors());
      }
      if($request->fupload === null) { $img = '/photos/no-images.jpg'; } else { $img = $request->fupload; }
      $cek = Berita::where('headline','Ya')->get()->count();
      if($request->headline == "Ya" && $cek > 4) { $headline = "Tidak"; } else { $headline = $request->headline; }
      $cek1 = Berita::where('title',$request->title)->first();
      if ($cek1 == $request->title) {
        Session::flash("flash_notification", [
          "level"   => "danger",
          "message" => "Judul Berita Telah Ada",
        ]);
        return redirect()->back();
      } else {
        $title = $request->title;
      }
      if (Auth::user()->hasRole('superadmin')) {
        Berita::create([
          'user_id' => Auth::user()->user_id,
          'kategori_berita_id' => $request->kategori,
          'title' => $title,
          'slug' => str_slug($title,'-'),
          'post_status' => $request->post_status,
          'headline' => $headline,
          'images' => $img,
          'description' => $request->description
        ]);
      } else {
        Berita::create([
          'user_id' => Auth::user()->user_id,
          'kategori_berita_id' => $request->kategori,
          'title' => $title,
          'slug' => str_slug($title,'-'),
          'post_status' => 'Draft',
          'headline' => 'Tidak',
          'images' => $img,
          'description' => $request->description
        ]);
      }
      Session::flash("flash_notification", [
        "level"   => "success",
        "message" => "Berita Berhasil Disimpan"
      ]);
      if ($cek === 4) {
        Session::flash("flash_notification", [
          "level"   => "danger",
          "message" => "Headline Hanya Boleh Max 4 !"
        ]);
        Session::flash("flash_notification", [
          "level"   => "success",
          "message" => "Berita Berhasil Disimpan"
        ]);
        if (Auth::user()->hasRole('superadmin')) {
          return redirect()->route('berita.index');
        } else {
          return redirect()->route('berita-editor.index');
        }
      }
      if (Auth::user()->hasRole('superadmin')) {
        return redirect()->route('berita.index');
      } else {
        return redirect()->route('berita-editor.index');
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $news = Berita::where('berita_id',$id)
              ->select('users.name','users.user_id','kategori_beritas.nama_kategori_berita','kategori_beritas.kategori_berita_id','beritas.*')
              ->join('kategori_beritas','kategori_beritas.kategori_berita_id','beritas.kategori_berita_id')
              ->join('users','users.user_id','beritas.user_id')
              ->first();
      return view('backend.berita.show', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $kategori = KategoriBerita::all();
      $news = Berita::where('berita_id',$id)
              ->select('kategori_beritas.nama_kategori_berita','kategori_beritas.kategori_berita_id','beritas.*')
              ->join('kategori_beritas','kategori_beritas.kategori_berita_id','beritas.kategori_berita_id')
              ->first();
      return view('backend.berita.edit',compact('news','kategori'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      if (Auth::user()->hasRole('superadmin')) {
        $validator = Validator::make(request()->all(), [
          'title' => 'required', 'headline' => 'required', 'post_status' => 'required', 'description' => 'required'
        ]);
      } else {
        $validator = Validator::make(request()->all(), [
          'title' => 'required', 'description' => 'required'
        ]);
      }

      if($validator->fails()) {
        Session::flash("flash_notification", [
          "level"   => "danger",
          "message" => "Please... field is required",
        ]);
        return redirect()->back()->withErrors($validator->errors());
      }
      if($request->images === null) { $img = '/photos/no-images.jpg'; } else { $img = $request->images; }
      $cek = Berita::where('headline','Ya')->get()->count();
      if($request->headline == "Ya" && $cek > 4) { $headline = "Tidak"; } else { $headline = $request->headline; }
      $cek1 = Berita::where('title',$request->title)->first();
      if ($cek1 == $request->title) {
        Session::flash("flash_notification", [
          "level"   => "danger",
          "message" => "Judul Berita Telah Ada",
        ]);
        return redirect()->back();
      } else {
        $title = $request->title;
      }
      $news = Berita::findOrFail($id);
      if (Auth::user()->hasRole('superadmin')) {
        $news->update([
          'user_id' => Auth::user()->user_id,
          'kategori_berita_id' => $request->kategori,
          'title' => $title,
          'slug' => str_slug($title,'-'),
          'post_status' => $request->post_status,
          'headline' => $headline,
          'images' => $img,
          'description' => $request->description
        ]);
      } else {
        $news->update([
          'user_id' => Auth::user()->user_id,
          'kategori_berita_id' => $request->kategori,
          'title' => $title,
          'slug' => str_slug($title,'-'),
          'images' => $img,
          'description' => $request->description
        ]);
      }
      Session::flash("flash_notification", [
        "level"   => "success",
        "message" => "Berita Berhasil Diubah"
      ]);
      if ($cek === 4) {
        Session::flash("flash_notification", [
          "level"   => "danger",
          "message" => "Headline Hanya Boleh Max 4 !"
        ]);
        Session::flash("flash_notification", [
          "level"   => "success",
          "message" => "Berita Berhasil Disimpan"
        ]);
        if (Auth::user()->hasRole('superadmin')) {
          return redirect()->route('berita.index');
        } else {
          return redirect()->route('berita-editor.index');
        }
      }
      if (Auth::user()->hasRole('superadmin')) {
        return redirect()->route('berita.index');
      } else {
        return redirect()->route('berita-editor.index');
      }
    }

    public function updateAdmin(Request $request, $id)
    {
      $news = Berita::where('berita_id',$id)->first();
      $news->update([
        'post_status' => $request->post_status
      ]);
      Session::flash("flash_notification", [
        "level"   => "success",
        "message" => "Berita Berhasil Diubah"
      ]);

      return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      Berita::destroy($id);
      if (Auth::user()->hasRole('superadmin')) {
        return redirect()->route('berita.index');
      } else {
        return redirect()->route('berita-editor.index');
      }
    }
}

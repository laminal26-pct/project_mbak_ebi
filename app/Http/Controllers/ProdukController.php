<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\KategoriProduk;
use Session, Auth, Validator;

class ProdukController extends Controller
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
      $product = Produk::select('kategori_produks.nama_kategori_produk','kategori_produks.kategori_produk_id','produks.*')
                 ->join('kategori_produks','kategori_produks.kategori_produk_id','produks.kategori_produk_id')
                 ->orderBy('created_at','desc')
                 ->get();
      return view('backend.produk.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $kategori = KategoriProduk::all();
      return view('backend.produk.create',compact('kategori'));
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
        'title' => 'required', 'harga' => 'required|numeric', 'stock' => 'required|numeric', 'description' => 'required'
      ]);

      if($validator->fails()) {
        Session::flash("flash_notification", [
          "level"   => "danger",
          "message" => "Please... field is required",
        ]);
        return redirect()->back()->withErrors($validator->errors());
      }
      if($request->fupload === null) { $img = '/photos/no-images.jpg'; } else { $img = $request->fupload; }
      $cek1 = Produk::where('title',$request->title)->first();
      if ($cek1 == $request->title) {
        Session::flash("flash_notification", [
          "level"   => "danger",
          "message" => "Judul Produk Telah Ada",
        ]);
        return redirect()->back();
      } else {
        $title = $request->title;
      }
      Produk::create([
        'kategori_produk_id' => $request->kategori,
        'title' => $title,
        'slug' => str_slug($title,'-'),
        'harga' => $request->harga,
        'stock' => $request->stock,
        'images' => $img,
        'description' => $request->description
      ]);
      Session::flash("flash_notification", [
        "level"   => "success",
        "message" => "Produk Berhasil Disimpan"
      ]);
      return redirect()->route('produk.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $product = Produk::where('produk_id',$id)
                 ->select('kategori_produks.nama_kategori_produk','kategori_produks.kategori_produk_id','produks.*')
                 ->join('kategori_produks','kategori_produks.kategori_produk_id','produks.kategori_produk_id')
                 ->first();
      return view('backend.produk.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $kategori = KategoriProduk::all();
      $product = Produk::where('produk_id',$id)
                 ->select('kategori_produks.nama_kategori_produk','kategori_produks.kategori_produk_id','produks.*')
                 ->join('kategori_produks','kategori_produks.kategori_produk_id','produks.kategori_produk_id')
                 ->first();
      return view('backend.produk.edit',compact('product','kategori'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $validator = Validator::make(request()->all(), [
        'title' => 'required', 'harga' => 'required|numeric', 'stock' => 'required|numeric', 'description' => 'required'
      ]);

      if($validator->fails()) {
        Session::flash("flash_notification", [
          "level"   => "danger",
          "message" => "Please... field is required",
        ]);
        return redirect()->back()->withErrors($validator->errors());
      }
      if($request->images == null) { $img = '/photos/no-images.jpg'; } else { $img = $request->images; }
      $cek1 = Produk::where('title',$request->title)->first();
      if ($cek1 == $request->title) {
        Session::flash("flash_notification", [
          "level"   => "danger",
          "message" => "Judul Produk Telah Ada",
        ]);
        return redirect()->back();
      } else {
        $title = $request->title;
      }
      $p = Produk::find($id);
      $p->update([
        'kategori_produk_id' => $request->kategori,
        'title' => $title,
        'slug' => str_slug($title,'-'),
        'harga' => $request->harga,
        'stock' => $request->stock,
        'images' => $img,
        'description' => $request->description
      ]);
      Session::flash("flash_notification", [
        "level"   => "success",
        "message" => "Produk Berhasil Diubah"
      ]);
      return redirect()->route('produk.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      Produk::destroy($id);
      return redirect()->route('produk.index');
    }
}

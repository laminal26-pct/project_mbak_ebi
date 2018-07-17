<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriProduk;
use App\Models\KategoriBerita;
use Session, Validator;

class KategoriController extends Controller
{
    public function __construct()
    {
      $this->middleware(['auth','role:superadmin']);
    }

    // Kategori Produk
    public function katpro_index()
    {
      $kat = KategoriProduk::all();
      return view('backend.kategori.katpor.index', compact('kat'));
    }

    public function katpro_store(Request $request)
    {
      $validator = Validator::make(request()->all(), [
        'nama_kategori_produk' => 'required|min:2'
      ]);
      if($validator->fails()) {
        Session::flash("flash_notification", [
          "level" => "danger",
          "message" => "Field tidak boleh kosong",
        ]);
        return redirect()->back()->withErrors($validator->errors());
      }
      KategoriProduk::create([
        'nama_kategori_produk' => $request->nama_kategori_produk
      ]);
      Session::flash("flash_notification", [
        "level" => "success",
        "message" => "Kategori Berhasil Disimpan"
      ]);
      return redirect()->route('produk.kategori');
    }

    public function katpro_edit($id)
    {
      $kat = KategoriProduk::findOrFail($id);
      return view('backend.kategori.katpor.edit', compact('kat'));
    }

    public function katpro_update(Request $request, $id)
    {
      $validator = Validator::make(request()->all(), [
        'nama_kategori_produk' => 'required|min:2'
      ]);
      if($validator->fails()) {
        Session::flash("flash_notification", [
          "level" => "danger",
          "message" => "Field tidak boleh kosong",
        ]);
        return redirect()->back()->withErrors($validator->errors());
      }
      $cat = KategoriProduk::find($id);
      $cat->update([
        'nama_kategori_produk' => $request->nama_kategori_produk
      ]);
      Session::flash("flash_notification", [
        "level" => "success",
        "message" => "Kategori Berhasil Dirubah"
      ]);
      return redirect()->route('produk.kategori');
    }

    public function katpro_destroy($id)
    {
      KategoriProduk::destroy($id);
      return redirect()->route('produk.kategori');
    }

    // Kategori Berita
    public function katber_index()
    {
      $kat = KategoriBerita::all();
      return view('backend.kategori.katber.index', compact('kat'));
      //dd($kat);
    }

    public function katber_store(Request $request)
    {
      $validator = Validator::make(request()->all(), [
        'nama_kategori_berita' => 'required|min:2'
      ]);
      if($validator->fails()) {
        Session::flash("flash_notification", [
          "level" => "danger",
          "message" => "Field tidak boleh kosong",
        ]);
        return redirect()->back()->withErrors($validator->errors());
      }
      KategoriBerita::create([
        'nama_kategori_berita' => $request->nama_kategori_berita
      ]);
      Session::flash("flash_notification", [
        "level" => "success",
        "message" => "Kategori Berhasil Disimpan"
      ]);
      return redirect()->route('berita.kategori.index');
    }

    public function katber_edit($id)
    {
      $kat = KategoriBerita::findOrFail($id);
      return view('backend.kategori.katber.edit', compact('kat'));
    }

    public function katber_update(Request $request, $id)
    {
      $validator = Validator::make(request()->all(), [
        'nama_kategori_berita' => 'required|min:2'
      ]);
      if($validator->fails()) {
        Session::flash("flash_notification", [
          "level" => "danger",
          "message" => "Field tidak boleh kosong",
        ]);
        return redirect()->back()->withErrors($validator->errors());
      }
      $cat = KategoriBerita::find($id);
      $cat->update([
        'nama_kategori_berita' => $request->nama_kategori_berita
      ]);
      Session::flash("flash_notification", [
        "level" => "success",
        "message" => "Kategori Berhasil Dirubah"
      ]);
      return redirect()->route('berita.kategori.index');
    }

    public function katber_destroy($id)
    {
      KategoriBerita::destroy($id);
      return redirect()->route('berita.kategori.index');
    }
}

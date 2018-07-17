<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Berita;
use App\Models\KategoriBerita;
use App\Models\Produk;
use App\Models\KategoriProduk;
use App\Models\Website;
use App\Models\Bank;
use App\Models\Konfirmasi;
use App\Models\Order;
use App\Models\Rating;
use App\Models\Album;
use App\Models\Photo;
use App\Models\Comment;
use Session, Validator, Mail, DB;
use App\Mail\Pemesanan;

class HomepageController extends Controller
{
    public function __construct()
    {
      $this->middleware('web');
    }

    public function home()
    {
      $news = Berita::select('users.name','users.user_id','kategori_beritas.nama_kategori_berita','kategori_beritas.kategori_berita_id','beritas.*')
              ->join('kategori_beritas','kategori_beritas.kategori_berita_id','beritas.kategori_berita_id')
              ->join('users','users.user_id','beritas.user_id')
              ->orderBy('created_at','desc')
              ->paginate(5);
      $kategori = KategoriBerita::all();
      $slide = Berita::where('post_status','Publikasi')->where('headline','Ya')->limit(4)->get();
      return view('frontend.home.index', compact('news','kategori','slide','active'));
    }

    public function v_berita($slug)
    {
      $news = Berita::where('slug',$slug)
              ->select('users.name','users.user_id','kategori_beritas.nama_kategori_berita','kategori_beritas.kategori_berita_id','beritas.*')
              ->join('kategori_beritas','kategori_beritas.kategori_berita_id','beritas.kategori_berita_id')
              ->join('users','users.user_id','beritas.user_id')
              ->first();
      if ($news) {
        return view('frontend.home.v_news', compact('news'));
      } else {
        return redirect()->route('404');
      }
    }

    public function kategori_berita($kategori)
    {
      $news = KategoriBerita::where('kategori_beritas.nama_kategori_berita',$kategori)
              ->select('users.name','users.user_id','kategori_beritas.*','beritas.*')
              ->join('beritas','kategori_beritas.kategori_berita_id','beritas.kategori_berita_id')
              ->join('users','users.user_id','beritas.user_id')
              ->paginate(5);
      $kat = KategoriBerita::all();
      $cek = KategoriBerita::where('nama_kategori_berita',$kategori)->first();
      $data = $kategori;
      if ($data == $cek['nama_kategori_berita']) {
        return view('frontend.home.category', compact('news','kat','data'));
      } else {
        return redirect()->route('404');
      }
    }

    public function listproduk()
    {
      $product = Produk::select('*')->where('stock','>','1')->orderBy('created_at','desc')->paginate(4);
      $kategori = KategoriProduk::all();
      return view('frontend.produk.index', compact('product','kategori'));
    }

    public function slugproduk($slug)
    {
      $product = Produk::with(['category','comment'])->where('slug',$slug)->where('stock','>','0')->first();
      if (!$product) {
        return redirect()->route('404');
      }
      $comment = Comment::where('produk_id',$product->produk_id)->orderBy('created_at','desc')->get();
      return view('frontend.produk.show',compact('product','comment'));
    }

    public function kategori_produk($kategori)
    {
      $product = KategoriProduk::where('kategori_produks.nama_kategori_produk',$kategori)
              ->select('kategori_produks.*','produks.*')
              ->join('produks','kategori_produks.kategori_produk_id','produks.kategori_produk_id')
              ->paginate(4);
      $kat = KategoriProduk::all();
      $cek = KategoriProduk::where('nama_kategori_produk',$kategori)->first();
      $data = $kategori;
      if ($data == $cek['nama_kategori_produk']) {
        return view('frontend.produk.category', compact('product','kat','data'));
      } else {
        return redirect()->route('404');
      }
    }

    public function komen_produk(Request $request, $slug)
    {
      $rules = [
        'name' => 'required',
        'email' => 'required|email',
        'description' => 'required'
      ];

      $validator = Validator::make(request()->all(),$rules);

      if ($validator->fails()) {
        return redirect()->back()->withErrors($validator->errors());
      }

      $product = Produk::where('slug',$slug)->first();

      Comment::create([
        'produk_id' => $product->produk_id,
        'name' => $request->name,
        'email' => $request->email,
        'description' => $request->description
      ]);

      return redirect()->route('produk.detail',$product->slug);
    }

    public function rbc_profil()
    {
      $website = Website::where('kategori_website','rbc')->first();
      if ($website) {
        return view('frontend.view',compact('website'));
      } else {
        return redirect()->route('404');
      }
    }

    public function pedado_profil()
    {
      $website = Website::where('kategori_website','pedado')->first();
      if ($website) {
        return view('frontend.view',compact('website'));
      } else {
        return redirect()->route('404');
      }
    }

    public function pr_rmh_jmr()
    {
      $website = Website::where('kategori_website','rumah-jamur')->first();
      if ($website) {
        return view('frontend.view',compact('website'));
      } else {
        return redirect()->route('404');
      }
    }

    public function pr_hydropolik()
    {
      $website = Website::where('kategori_website','hydropolik')->first();
      if ($website) {
        return view('frontend.view',compact('website'));
      } else {
        return redirect()->route('404');
      }
    }

    public function pr_pendidikan()
    {
      $website = Website::where('kategori_website','pendidikan')->first();
      if ($website) {
        return view('frontend.view',compact('website'));
      } else {
        return redirect()->route('404');
      }
    }

    public function ukm_katur()
    {
      $website = Website::where('kategori_website','katur-lihab')->first();
      if ($website) {
        return view('frontend.view',compact('website'));
      } else {
        return redirect()->route('404');
      }
    }

    public function ukm_kar()
    {
      $website = Website::where('kategori_website','kar-flanet')->first();
      if ($website) {
        return view('frontend.view',compact('website'));
      } else {
        return redirect()->route('404');
      }
    }

    public function ukm_lampu()
    {
      $website = Website::where('kategori_website','lampu-hias')->first();
      if ($website) {
        return view('frontend.view',compact('website'));
      } else {
        return redirect()->route('404');
      }
    }

    public function gallery()
    {
      $album = Album::with('photos')->get();
      return view('frontend.gallery',compact('album'));
    }

    public function foto($id)
    {
      $album = Album::with('photos')->find($id);
      return view('frontend.photo',compact('album'));
    }

    public function maps()
    {
      return view('frontend.maps');
    }

    public function upload_bukti($email,$kode_order)
    {
      $bank = Bank::all();
      return view('frontend.upload', compact('email','kode_order','bank'));
    }

    public function post_upload(Request $request, $email, $kode_order)
    {
      $validator = Validator::make($request->all(), [
        'images' => 'required|image|mimes:jpeg,png,jpg|max:2048',
      ]);

      $order = Order::where('email',$email)->where('kode_order',$kode_order)->first();

      $cek = Konfirmasi::where('order_id',$order->order_id)->first();
      if ($cek) {
        return redirect()->back()->withErrorMessage('Orderan Sudah Mengirimkan Bukti Pembayaran');
      }
      if ($validator->passes()) {
        Konfirmasi::create([
          'bank_id' => $request->bank,
          'order_id' => $order->order_id,
          'files' => $input['images'] = time().'.'.$request->images->getClientOriginalExtension()
        ]);
        $request->images->move(public_path('uploads'), $input['images']);
        return redirect()->back()->withSuccessMessage('Orderan Sukses Mengirimkan Bukti Pembayaran');
      }
      return redirect()->back()->withErrorMessage($validator->errors()->all());
    }

    public function terima_brg($email,$kode_order,$kode_unik)
    {
      $cek = Order::where('email',$email)->where('kode_order',$kode_order)->where('kode_unik',$kode_unik)->first();
      if ($cek) {
        $cek->update([
          'status_pengiriman' => 'Sampai'
        ]);
        return view('frontend.penilaian',compact('cek'))->withSuccessMessage('Orderan Telah Anda Terima. Terima kasih !');
      } else {
        return view('frontend.penilaian')->withErrorMessage('Verifikasi penerimaan barang tidak ditemukan !');
      }
    }

    public function penilaian(Request $request, $kode_order)
    {
      $order = Order::where('kode_order',$kode_order)->first();
      $cek = Rating::where('order_id',$order->order_id)->first();
      if ($cek) {
        return redirect()->back()->withErrorMessage('Anda sudah melakukan penilaian');
      }
      $rating = Rating::create([
        'order_id' => $order->order_id,
        'nilai' => $request->rating_input
      ]);
      return redirect()->back()->withSuccessMessage('Terima Kasih Penilaian Anda');
    }
}

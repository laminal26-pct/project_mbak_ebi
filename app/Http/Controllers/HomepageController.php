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
use App\Models\Relawan;
use App\Models\Video;
use Session, Validator, Mail, DB;
use App\Mail\Pemesanan;

class HomepageController extends Controller
{
    public function __construct()
    {
      $this->middleware('web');
    }

    protected function relawan()
    {
      $relawan = Relawan::where('status','Aktif')->get();
      return $relawan;
    }

    public function relawanShow($slug) {
      $relawan = Relawan::select('nama','images','status','alamat','joined')->where('slug',$slug)->first();
      if ($relawan) {
        return response()->json($relawan, 201);
      }
      return response()->json(['message' => 'Not avaiable'],404);
    }

    protected function video() {
      $video = Video::where('status','Aktif')->get();
      return $video;
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
      $relawan = $this->relawan();
      $video = $this->video();
      return view('frontend.home.index', compact('news','kategori','slide','active','relawan','video'));
    }

    public function v_berita($slug)
    {
      $relawan = $this->relawan();
      $news = Berita::where('slug',$slug)
              ->select('users.name','users.user_id','kategori_beritas.nama_kategori_berita','kategori_beritas.kategori_berita_id','beritas.*')
              ->join('kategori_beritas','kategori_beritas.kategori_berita_id','beritas.kategori_berita_id')
              ->join('users','users.user_id','beritas.user_id')
              ->first();
      if ($news) {
        return view('frontend.home.v_news', compact('news','relawan'));
      } else {
        return redirect()->route('404');
      }
    }

    public function kategori_berita($kategori)
    {
      $relawan = $this->relawan();
      $news = KategoriBerita::where('kategori_beritas.nama_kategori_berita',$kategori)
              ->select('users.name','users.user_id','kategori_beritas.*','beritas.*')
              ->join('beritas','kategori_beritas.kategori_berita_id','beritas.kategori_berita_id')
              ->join('users','users.user_id','beritas.user_id')
              ->paginate(5);
      $kat = KategoriBerita::all();
      $cek = KategoriBerita::where('nama_kategori_berita',$kategori)->first();
      $data = $kategori;
      if ($data == $cek['nama_kategori_berita']) {
        return view('frontend.home.category', compact('news','kat','data','relawan'));
      } else {
        return redirect()->route('404');
      }
    }

    public function listproduk()
    {
      $relawan = $this->relawan();
      $product = Produk::select('*')->where('stock','>','1')->orderBy('created_at','desc')->paginate(4);
      $kategori = KategoriProduk::all();
      return view('frontend.produk.index', compact('product','kategori','relawan'));
    }

    public function slugproduk($slug)
    {
      $relawan = $this->relawan();
      $product = Produk::with(['category','comment'])->where('slug',$slug)->where('stock','>','0')->first();
      if (!$product) {
        return redirect()->route('404');
      }
      $comment = Comment::where('produk_id',$product->produk_id)->orderBy('created_at','desc')->get();
      return view('frontend.produk.show',compact('product','comment','relawan'));
    }

    public function kategori_produk($kategori)
    {
      $relawan = $this->relawan();
      $product = KategoriProduk::where('kategori_produks.nama_kategori_produk',$kategori)
              ->select('kategori_produks.*','produks.*')
              ->join('produks','kategori_produks.kategori_produk_id','produks.kategori_produk_id')
              ->paginate(4);
      $kat = KategoriProduk::all();
      $cek = KategoriProduk::where('nama_kategori_produk',$kategori)->first();
      $data = $kategori;
      if ($data == $cek['nama_kategori_produk']) {
        return view('frontend.produk.category', compact('product','kat','data','relawan'));
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
      $relawan = $this->relawan();
      $website = Website::where('kategori_website','rbc')->first();
      if ($website) {
        return view('frontend.view',compact('website','relawan'));
      } else {
        return redirect()->route('404');
      }
    }

    public function pedado_profil()
    {
      $relawan = $this->relawan();
      $website = Website::where('kategori_website','pedado')->first();
      if ($website) {
        return view('frontend.view',compact('website','relawan'));
      } else {
        return redirect()->route('404');
      }
    }

    public function pr_rmh_jmr()
    {
      $relawan = $this->relawan();
      $website = Website::where('kategori_website','rumah-jamur')->first();
      if ($website) {
        return view('frontend.view',compact('website','relawan'));
      } else {
        return redirect()->route('404');
      }
    }

    public function pr_hydropolik()
    {
      $relawan = $this->relawan();
      $website = Website::where('kategori_website','hydropolik')->first();
      if ($website) {
        return view('frontend.view',compact('website','relawan'));
      } else {
        return redirect()->route('404');
      }
    }

    public function pr_pendidikan()
    {
      $relawan = $this->relawan();
      $website = Website::where('kategori_website','pendidikan')->first();
      if ($website) {
        return view('frontend.view',compact('website','relawan'));
      } else {
        return redirect()->route('404');
      }
    }

    public function ukm_katur()
    {
      $relawan = $this->relawan();
      $website = Website::where('kategori_website','katur-lihab')->first();
      if ($website) {
        return view('frontend.view',compact('website','relawan'));
      } else {
        return redirect()->route('404');
      }
    }

    public function ukm_kar()
    {
      $relawan = $this->relawan();
      $website = Website::where('kategori_website','kar-flanet')->first();
      if ($website) {
        return view('frontend.view',compact('website','relawan'));
      } else {
        return redirect()->route('404');
      }
    }

    public function ukm_lampu()
    {
      $relawan = $this->relawan();
      $website = Website::where('kategori_website','lampu-hias')->first();
      if ($website) {
        return view('frontend.view',compact('website','relawan'));
      } else {
        return redirect()->route('404');
      }
    }

    public function gallery()
    {
      $relawan = $this->relawan();
      $album = Album::with('photos')->get();
      return view('frontend.gallery',compact('album','relawan'));
    }

    public function foto($id)
    {
      $relawan = $this->relawan();
      $album = Album::with('photos')->find($id);
      return view('frontend.photo',compact('album','relawan'));
    }

    public function maps()
    {
      $relawan = $this->relawan();
      return view('frontend.maps',compact('relawan'));
    }

    public function upload_bukti($email,$kode_order)
    {
      $relawan = $this->relawan();
      $bank = Bank::all();
      return view('frontend.upload', compact('email','kode_order','bank','relawan'));
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
      $relawan = $this->relawan();
      $cek = Order::where('email',$email)->where('kode_order',$kode_order)->where('kode_unik',$kode_unik)->first();
      if ($cek) {
        $cek->update([
          'status_pengiriman' => 'Sampai'
        ]);
        return view('frontend.penilaian',compact('cek','relawan'))->withSuccessMessage('Orderan Telah Anda Terima. Terima kasih !');
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

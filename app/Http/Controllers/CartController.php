<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Cart as Cart;
use App\Models\Produk;
use App\Models\Order;
use App\Models\ProdukOrder;
use App\Models\Relawan;
use Validator, Mail, Session;
use App\Mail\Pemesanan;

class CartController extends Controller
{
    protected function relawan()
    {
      $relawan = Relawan::where('status','Aktif')->get();
      return $relawan;
    }

    public function relawanShow($slug) {
      $relawan = Relawan::select('nama','images','status','alamat','join')->where('slug',$slug)->first();
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
        $relawan = $this->relawan();
        return view('frontend.cart.index', compact('relawan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $duplicates = Cart::search(function ($cartItem, $rowId) use ($request) {
          return $cartItem->id === $request->produk_id;
        });

        if (!$duplicates->isEmpty()) {
          return redirect()->route('cart.index')->withSuccessMessage('Item telah ada di keranjang');
        }
        Cart::add($request->produk_id, $request->title, 1, $request->harga)->associate('App\Models\Produk');
        return redirect()->route('cart.index')->withSuccessMessage('Item telah ditambahkan dalam keranjang');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $validator = Validator::make($request->all(), [
          'quantity' => 'required|numeric|between:1,10'
        ]);

        if ($validator->fails()) {
          session()->flash('error_message','Kuantitas hanya 1 sampai 10.');
          return response()->json(['success' => false]);
        }

        Cart::update($id, $request->quantity);
        session()->flash('success_message','Kuantitas telah diubah');

        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::remove($id);
        return redirect()->route('cart.index')->withSuccessMessage('Item telah dihapus');
    }

    /**
     * Remove the resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function emptyCart()
    {
      Cart::destroy();
      return redirect()->route('cart.index')->withSuccessMessage('Keranjang kamu telah dihapus');
    }

    public function pesan()
    {
      $kodeUnik = rand(100,999);
      $cek = Cart::total();
      $total = preg_replace("/([^0-9\\.])/i","",$cek);
      $all = $kodeUnik + $total;
      $relawan = $this->relawan();
      return view('frontend.cart.pesan',compact('kodeUnik','total','all','relawan'));
    }

    public function postPesan(Request $request)
    {
      Validator::make(request()->all(), [
        'nama' => 'required',
        'email' => 'required|email',
        'telepon' => 'required',
        'alamat' => 'required'
      ]);
      // Kode Transaksi Start //
      $tgl = date('Ymd');
      $con = Order::all()->count();
      if ($con > 0) {
        $cek = Order::select('kode_order as last')
               ->where('kode_order','like','%'.$tgl.'%')
               ->max('kode_order');
        $las = substr($cek,8,4);
        $next = $las + 1;
      } else {
        $las = substr($con,8,4);
      }
      $next = $las + 1;
      $kode = $tgl.sprintf('%04s',$next);
      $total = preg_replace("/([^0-9\\.])/i","",$request->totalall);

      $order = Order::create([
        'kode_order' => $kode,
        'kode_unik' => $request->kodeUnik,
        'total' => $total,
        'nama' => $request->nama,
        'email' => $request->email,
        'telepon' => $request->telepon,
        'alamat' => $request->alamat,
        'status_pembayaran' => 'Belum Lunas',
        'status_pengiriman' => 'Proses'
      ]);
      // Kode Transaksi End //

      $thisUser = Order::findOrfail($order->order_id);
      $this->sendNotif($thisUser);
      if (sizeof(Cart::content()) > 0) {
        foreach (Cart::content() as $item) {
          ProdukOrder::create([
            'produk_id' => $item->model->produk_id,
            'order_id' => $order->order_id,
            'jumlah' => $item->qty,
          ]);
          $produk = Produk::findOrfail($item->model->produk_id);
          $stok = $produk->stock - $item->qty;
          $produk->update([
            'stock' => $stok
          ]);
        }

        Cart::destroy();
        return redirect()->route('produk.list')->withSuccessMessage('Produk telah dipesan');
      }
    }

    public function sendNotif($thisUser)
    {
      Mail::to($thisUser['email'])->send(new Pemesanan($thisUser));
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\ProdukOrder;
use App\Models\Tracking;
use App\Mail\Pengiriman;
use Mail;

class OrderController extends Controller
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
      $order = Order::select('*')->orderBy('created_at','desc')->get();
      return view('backend.order.index', compact('order'));
    }
    /*
    public function upPembayaran(Request $request, $id)
    {
      $produk = Order::where('kode_order',$id)->first();
      $produk->update([
        'status_pembayaran' => $request->bayar
      ]);
      session()->flash('success_message','Pembayaran telah lunas');

      return response()->json(['success' => true]);
    }
    */
    public function upPengiriman(Request $request, $id)
    {
        $produk = Order::where('kode_order',$id)->first();
        $produk->update([
          'status_pengiriman' => $request->pengiriman
        ]);
        session()->flash('success_message','Pengiriman telah dirubah');

        return response()->json(['success' => true]);
    }

    public function upForm($data)
    {
      $produk = Order::where('kode_order',$data)->first();
      return view('backend.order.pengiriman',compact('produk'));
    }

    public function postForm(Request $request, $data)
    {
      $produk = Order::where('kode_order',$data)->first();
      $produk->update([
        'status_pengiriman' => 'Kirim'
      ]);
      Tracking::create([
        'order_id' => $produk->order_id,
        'jasa_pengiriman' => $request->jasa_pengiriman,
        'no_resi' => $request->no_resi
      ]);
      $thisUser = Order::findOrfail($produk->order_id);
      $this->pengiriman($thisUser);

      session()->flash('success_message',$produk->kode_order." Transaksi ini telah dikirim");

      return redirect()->route('order.index');
    }

    public function pengiriman($thisUser)
    {
      Mail::to($thisUser['email'])->send(new Pengiriman($thisUser));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $order = Order::select('*')
               ->where('kode_order',$id)
               ->first();
      $track = Tracking::where('order_id',$order->order_id)->first();
      $produk = ProdukOrder::select('produk_orders.*','produks.*','orders.kode_order','orders.order_id')
                ->join('orders','orders.order_id','produk_orders.order_id')
                ->join('produks','produks.produk_id','produk_orders.produk_id')
                ->where('orders.kode_order',$id)
                ->get();
      $order->update([
        'read' => 1
      ]);
      return view('backend.order.show', compact('order','produk','track'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      Order::destroy($id);
      return redirect()->route('order.index');
    }
}

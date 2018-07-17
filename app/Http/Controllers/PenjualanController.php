<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Order;
use App\Models\ProdukOrder;
use App\Models\Tracking;
use PDF;

class PenjualanController extends Controller
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
        /*$jual = Order::select('produk_orders.*','produks.title','produks.produk_id','orders.*','orders.created_at as tgl_pesan','trackings.*')
                ->join('produk_orders','produk_orders.order_id','orders.order_id')
                ->join('produks','produk_orders.produk_id','produks.produk_id')
                ->join('trackings','trackings.order_id','orders.order_id')
                ->where('orders.status_pembayaran', 'Lunas')
                ->where('orders.status_pengiriman', 'Sampai')
                ->orderBy('orders.updated_at','desc')
                ->get();
        */
        $jual = Order::select('orders.*','orders.created_at as tgl_pesan','trackings.*', 'trackings.created_at as tgl_kirim')
                ->join('trackings','trackings.order_id','orders.order_id')
                ->where('orders.status_pembayaran', 'Lunas')
                ->where('orders.status_pengiriman', 'Sampai')
                ->orderBy('orders.updated_at','desc')
                ->get();
        return view('backend.penjualan.index',compact('jual'));
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
        //
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

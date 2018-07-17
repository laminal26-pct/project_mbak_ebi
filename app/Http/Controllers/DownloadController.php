<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\ProdukOrder;
use App\Models\Tracking;
use App\Models\Konfirmasi;
use App\Models\Bank;
use PDF;

class DownloadController extends Controller
{
    public function download($token, $id)
    {
      $order = Order::select('*')
               ->where('kode_order',$id)
               ->where('kode_unik',$token)
               ->first();
      if (!$order) {
        return redirect()->route('404');
      }
      $track = Tracking::where('order_id',$order->order_id)->first();
      $produk = ProdukOrder::select('produk_orders.*','produks.*','orders.kode_order','orders.order_id')
                ->join('orders','orders.order_id','produk_orders.order_id')
                ->join('produks','produks.produk_id','produk_orders.produk_id')
                ->where('orders.kode_order',$id)
                ->get();
      $konfir = Konfirmasi::select('konfir_bayar.*','banks.*')
                ->join('banks','banks.bank_id','konfir_bayar.bank_id')
                ->where('order_id',$order->order_id)
                ->first();

      $pdf = PDF::loadView('pdf',compact('order','track','produk','konfir'))
             ->setPaper('a4','potrait');//->save('files/'.$order->kode_order.'.pdf');
      //return $pdf->download($jual->kode_transaksi.'-'.$jual->nama.'.pdf');
      return $pdf->stream($order->kode_order.'.pdf');
    }
    /*
    public function download_penjualan($token, $kode_order)
    {
      $order = Order::select('*')
               ->where('kode_order',$kode_order)
               ->where('kode_unik',$token)
               ->first();
      $track = Tracking::where('order_id',$order->order_id)->first();
      $produk = ProdukOrder::select('produk_orders.*','produks.*','orders.kode_order','orders.order_id')
                ->join('orders','orders.order_id','produk_orders.order_id')
                ->join('produks','produks.produk_id','produk_orders.produk_id')
                ->where('orders.kode_order',$kode_order)
                ->get();
      $konfir = Konfirmasi::select('konfir_bayar.*','banks.*')
                ->join('banks','banks.bank_id','konfir_bayar.bank_id')
                ->where('order_id',$order->order_id)
                ->first();

      $pdf = PDF::loadView('pdf',compact('order','track','produk','konfir'))
             ->setPaper('a4','potrait')->save('files/'.$order->kode_order.'.pdf');
      //return $pdf->download($order->kode_order.'.pdf');
      return $pdf->stream($order->kode_order.'.pdf');
    }*/
}

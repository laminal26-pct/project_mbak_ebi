<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Konfirmasi;
use App\Models\Order;
use App\Mail\Pembayaran;
use Session, Auth, Mail, Validator, Hash;

class DashboardController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function admin()
    {
      $order = Order::where('status_pembayaran','Belum Lunas')->where('status_pengiriman','Proses')->orderBy('created_at','desc')->get();
      $konfir = Konfirmasi::select('konfir_bayar.*','orders.*','banks.*')
                ->join('orders','orders.order_id','konfir_bayar.order_id')
                ->join('banks','banks.bank_id','konfir_bayar.bank_id')
                ->where('orders.status_pembayaran','Belum Lunas')
                ->orderBy('konfir_bayar.created_at','desc')
                ->get();
      $user = User::all();
      $produk = \App\Models\Produk::all();
      $pro = \App\Models\Produk::orderBy('created_at','desc')->whereMonth('created_at',date('m',strtotime('now')))->limit(5)->get();

      //$addProduk = \App\Models\Produk::whereDate('created_at','=', date('Y-m-d',strtotime('-7 Days',strtotime('now'))))->get();
      //dd($pro);
      //dd('Tanggal Buat'.date('Y-m-d',strtotime($pro->created_at)).'Tanggal Exp'.date('Y-m-d',strtotime('+7 Days',strtotime($pro->created_at))));
      //dd($addProduk);
      return view('backend.dashboard',compact('order','konfir','user','produk','pro'));
    }

    public function editor()
    {
      return view('backend.dashboard');
    }

    public function gallery()
    {
      return view('backend.gallery');
    }

    public function files()
    {
      return view('backend.files');
    }

    public function showPasswordForm()
    {
      return view('auth.changepassword');
    }

    public function postPassword(Request $request)
    {
      $validator = Validator::make(request()->all(), [
        'old' => 'required',
        'password' => 'required|string|min:8|confirmed',
        'password_confirmation' => 'required|string|min:8|same:password'
      ]);
      if ($validator->fails()) {
        Session::flash("flash_notification", [
          "level"   => "warning",
          "message" => "Password Tidak Sama !!!"
        ]);
        return redirect()->back()->withErrors($validator);
      }
      $user = User::find(Auth::id());
      $hashedPassword = $user->password;

      if (Hash::check($request->old, $hashedPassword)) {
        $user->update([
          'password' => Hash::make($request->password)
        ]);
        Session::flash("flash_notification", [
          "level"   => "success",
          "message" => "Password Sukses Dirubah."
        ]);
        return redirect()->back();
      } else {
        Session::flash("flash_notification", [
          "level"   => "danger",
          "message" => "Password Tidak Sesuai Dengan Password Lama Anda !!!"
        ]);
        return redirect()->back();
      }
    }

    public function index_konfir()
    {
      $konfir = Konfirmasi::select('konfir_bayar.*','orders.*','banks.*')
                ->join('orders','orders.order_id','konfir_bayar.order_id')
                ->join('banks','banks.bank_id','konfir_bayar.bank_id')
                ->orderBy('konfir_bayar.created_at','desc')
                ->get();
      return view('backend.konfir.index',compact('konfir'));
    }

    public function show_konfir($id)
    {
      $konfir = Konfirmasi::select('konfir_bayar.*','konfir_bayar.created_at as tgl_kirim','orders.*','banks.*')
                ->join('orders','orders.order_id','konfir_bayar.order_id')
                ->join('banks','banks.bank_id','konfir_bayar.bank_id')
                ->where('konfir_bayar.bayar_id',$id)
                ->first();
      return view('backend.konfir.show',compact('konfir'));
    }

    public function upPembayaran(Request $request, $id)
    {
      $produk = Order::where('kode_order',$id)->first();
      $produk->update([
        'status_pembayaran' => $request->bayar
      ]);
      $thisUser = Order::findOrfail($produk->order_id);
      $this->pembayaran($thisUser);

      session()->flash('success_message','Pembayaran telah lunas');

      return response()->json(['success' => true]);
    }

    public function pembayaran($thisUser)
    {
      Mail::to($thisUser['email'])->send(new Pembayaran($thisUser));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bank;
use Session, Validator;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bank = Bank::all();
        return view('backend.bank.index',compact('bank'));
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
      $validator = Validator::make(request()->all(), [
        'nama_bank' => 'required|min:2',
        'no_rek' => 'required',
        'atas_nama' => 'required'
      ]);
      if($validator->fails()) {
        Session::flash("flash_notification", [
          "level" => "danger",
          "message" => "Field tidak boleh kosong",
        ]);
        return redirect()->back()->withErrors($validator->errors());
      }
      Bank::create([
        'nama_bank' => $request->nama_bank,
        'no_rek' => $request->no_rek,
        'atas_nama' => $request->atas_nama
      ]);
      Session::flash("flash_notification", [
        "level" => "success",
        "message" => "Bank Berhasil Disimpan"
      ]);
      return redirect()->route('bank.index');
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
        $bank = Bank::findOrFail($id);
        return view('backend.bank.edit', compact('bank'));
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
      $validator = Validator::make(request()->all(), [
        'nama_bank' => 'required|min:2',
        'no_rek' => 'required',
        'atas_nama' => 'required'
      ]);
      if($validator->fails()) {
        Session::flash("flash_notification", [
          "level" => "danger",
          "message" => "Field tidak boleh kosong",
        ]);
        return redirect()->back()->withErrors($validator->errors());
      }
      $bank = Bank::find($id);
      $bank->update([
        'nama_bank' => $request->nama_bank,
        'no_rek' => $request->no_rek,
        'atas_nama' => $request->atas_nama
      ]);
      Session::flash("flash_notification", [
        "level" => "success",
        "message" => "Bank Berhasil Dirubah"
      ]);
      return redirect()->route('bank.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Bank::destroy($id);
        return redirect()->route('bank.index');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Role;
use Session, Mail, Validator;
use App\Mail\VerifyEmail;

class UserController extends Controller
{
    public function __construct()
    {
      $this->middleware(['auth','role:superadmin']);
    }

    protected function code_password($length)
    {
      $char = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
      $str = "";
      for ($i=1; $i <= $length; $i++) {
        $pos = rand(0, strlen($char)-1);
        $str .= $char{$pos};
      }
      return $str;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $user = User::select('users.*','roles.display_name as level', 'roles.id')
              ->join('role_user','users.user_id','role_user.user_id')
              ->join('roles','roles.id','role_user.role_id')
              ->get();
      return view('backend.users.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $role = Role::all();
      return view('backend.users.create',compact('role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $users = User::select('email')->where('email','=',$request->email)->get();
      if ($users === $request->email) {
        Session::flash("flash_notification", [
          "level"   => "warning",
          "message" => "Email Ini Telah Terdaftar ! Mohon Menggunakan Email Lainnya !"
        ]);
        return redirect()->back();
      }
      $validator = Validator::make(request()->all(), [
        'name' => 'required|string|max:191',
        'email' => 'required|string|email|max:191|unique:users',
        'level' => 'required'
      ]);
      if ($validator->fails()) {
        Session::flash("flash_notification", [
          "level"   => "danger",
          "message" => "Please.. field is required",
        ]);
        return redirect()->back()->withErrors($validator->errors());
      }
      $user = User::create([
        'name'        => $request->name,
        'email'       => $request->email,
        'password'    => bcrypt($this->code_password(8)),
        'verifyToken' => Str::random(40)
      ]);
      $role = Role::where('name',$request->level)->first();
      $user->attachRole($role);
      Session::flash("flash_notification", [
        "level"   => "success",
        "message" => "Akun Pengguna Telah Ditambahkan. Silahkan Melakukan Verifikasi Email Untuk Aktivasi"
      ]);
      if(!$user->save()) {
        abort(500);
      }
      $thisUser = User::findOrfail($user->user_id);
      $this->sendEmail($thisUser);
      return redirect()->route('pengguna.index');
    }

    // KIRIM EMAIL KE AKUN PENGGUNA BARU //
    public function sendEmail($thisUser)
    {
      Mail::to($thisUser['email'])->send(new VerifyEmail($thisUser));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $user = User::select('users.*','roles.display_name as level', 'roles.id')
              ->join('role_user','users.user_id','role_user.user_id')
              ->join('roles','roles.id','role_user.role_id')
              ->where('users.user_id',$id)
              ->first();
      return view('backend.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $role = Role::all();
      $user = User::select('users.*','roles.display_name as level', 'roles.id', 'roles.name as levelname')
              ->join('role_user','users.user_id','role_user.user_id')
              ->join('roles','roles.id','role_user.role_id')
              ->where('users.user_id',$id)
              ->first();
      return view('backend.users.edit', compact('user','role'));
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
        'name' => 'required|string|max:191',
        'email' => 'required|string|email|max:191'
      ]);
      if ($validator->fails()) {
        Session::flash("flash_notification", [
          "level"   => "danger",
          "message" => "Please.. field is required",
        ]);
        return redirect()->back()->withErrors($validator->errors());
      }
      $users = User::findOrfail($id);
      $users->update([
        'name'   => $request->name,
        'email'  => $request->email
      ]);
      /*$role = Role::select('id','name')->where('name',$request->level)->first();
      if (!$role->name === $request->level) {
        $users->attachRole($role);
      }*/
      Session::flash("flash_notification", [
        "level"   => "success",
        "message" => "Akun Pengguna Telah Dirubah."
      ]);
      return redirect()->route('pengguna.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      User::destroy($id);
      return redirect()->route('pengguna.index');
    }
}

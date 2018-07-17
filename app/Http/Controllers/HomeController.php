<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Role;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $role = DB::table('users')
              ->join('role_user','users.user_id', '=' ,'role_user.user_id')
              ->join('roles','roles.id', '=', 'role_user.role_id')
              ->select('roles.name','users.status')
              ->where('users.email','=', Auth::user()->email)
              ->first();
      if ($role->name === "admin") {
        // Dashboard Admin
        return redirect()->intended('/dashboard/editor');
      } elseif ($role->name === "superadmin") {
        // Dashboard Direktur // Dashboard Manager // Dashboard Staff
        return redirect()->intended('/dashboard/administrator');
      } else {
        Session::flash("flash_notification", [
          "level" => "danger",
          "message" => "Access Forbidden"
        ]);
        return redirect()->intended('/login');
      }
    }
}

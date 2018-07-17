<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Session, Validator, Auth, DB;

class AuthController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
      $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
      return view('auth.login');
    }

    public function login(Request $request)
    {
      $this->validate($request, [
        'email' => 'required|email|exists:users,email',
        'password' => 'required|min:8',
      ]);

      $attempts = [
        'email' => $request->email,
        'password' => $request->password,
        'status' => 'Activated',
      ];
      // CHECK STATUS, IF TRUE CAN LOGIN.
      if (Auth::attempt($attempts, (bool) $request->remember)) {
        $users = DB::table('users')
                      ->join('role_user','users.user_id', '=' ,'role_user.user_id')
                      ->join('roles','roles.id', '=', 'role_user.role_id')
                      ->select('roles.name','users.status')
                      ->where('users.email','=', $request->email)
                      ->get();
        // REDIRECT PAGE WITH ROLE
        foreach ($users as $list) {
          if ($list->name === "admin") {
            // Dashboard Admin
            return redirect()->intended('/dashboard/editor');
            //return redirect()->route('dashboard.editor');
          } elseif ($list->name === "superadmin") {
            // Dashboard Direktur // Dashboard Manager // Dashboard Staff
            return redirect()->intended('/dashboard/administrator');
            //return redirect()->route('dashboard.admin');
          } else {
            Session::flash("flash_notification", [
              "level" => "danger",
              "message" => "Access Forbidden"
            ]);
            return redirect()->intended('/login');
          }
        }
        // END REDIRECT PAGE WITH ROLE
      } else {
        $cek = DB::table('users')
               ->join('role_user','users.user_id', '=' ,'role_user.user_id')
               ->join('roles','roles.id', '=', 'role_user.role_id')
               ->select('roles.name','users.status')
               ->where('users.email', $request->email)
               ->get();
        // CHECK LOGIN, IF ROLE TRUE OR STATUS TRUE BUT PASSWORD WRONG
        foreach ($cek as $k) {
          $sts = $k->status;
          if ($sts == "Activated") {
            Session::flash("flash_notification", [
              "level" => "danger",
              "message" => "Email or Password is Wrong !"
            ]);
            return redirect()->intended('/login');
          } elseif ($sts == "Blocked") {
            Session::flash("flash_notification", [
              "level" => "danger",
              "message" => "Account Blocked. Call Us Administrator for Active Your Account !"
            ]);
            return redirect()->intended('/login');
          } else {
            Session::flash("flash_notification", [
              "level" => "warning",
              "message" => "Please.. Verification Your Email !"
            ]);
            return redirect()->intended('/login');
          }
        }
        // END CHECK LOGIN
      }
      Session::flash("flash_notification", [
        "level" => "danger",
        "message" => "Access Forbidden"
      ]);
      return redirect()->intended('/login');
    }

    public function verification($email, $token)
    {
      $user = User::where(['email' => $email, 'verifyToken' => $token])->first();
      if($user == null) {
        Session::flash("flash_notification", [
          "level"   => "danger",
          "message" => "Sorry ! Your account link has expired !!"
        ]);
        return redirect()->route('login');
      } else {
        return view('auth.setPassword',compact('user'));
      }
    }

    public function save(Request $request, $email, $token)
    {
      $users = User::where(['email' => $email, 'verifyToken' => $token])->first();
      if ($users) {
        $validator = Validator::make(request()->all(), [
          'password' => 'required|string|min:8|confirmed',
          'password_confirmation' => 'required|string|min:8|same:password'
        ]);
        if ($validator->fails()) {
          Session::flash("flash_notification", [
            "level"   => "danger",
            "message" => "Password Does not match",
          ]);
          return redirect()->back()->withErrors($validator->errors());
        }
        $users = User::where(['email' => $email, 'verifyToken' => $token])
                 ->update([
                   'password' => bcrypt($request->password),
                   'status' => 'Activated',
                   'verifyToken' => NULL
                 ]);
        Session::flash("flash_notification", [
          "level"   => "success",
          "message" => "Congratulations, Your Account is Active !"
        ]);
        return redirect()->route('login');
      } else {
        Session::flash("flash_notification", [
          "level"   => "danger",
          "message" => "Sorry, Your Account Can't be Verified !"
        ]);
        return redirect()->route('verifikasi');
      }
    }

    protected function credentials(Request $request)
    {
        return ['email' => $request->{$this->username()}, 'password' => $request->password, 'status' => 'Activated'];
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();
        return redirect('/');
    }

    protected function guard()
    {
        return Auth::guard();
    }
}

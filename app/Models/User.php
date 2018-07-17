<?php

namespace App\Models;

use Eloquent;
use App\Models\User;
use App\Models\Role;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Eloquent implements Authenticatable, CanResetPasswordContract
{
    use Notifiable, CanResetPassword, AuthenticableTrait;
    //use SoftDeletes { restore as private restoreB; }
    use EntrustUserTrait { restore as private restoreA; }

    public $primaryKey = "user_id";

    protected $table = "users";

    public function restore()
    {
      $htis->restoreA();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'verifyToken', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}

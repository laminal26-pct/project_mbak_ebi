<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Relawan extends Model
{
    protected $table = "relawans";

    public $primaryKey = "relawan_id";

    public $fillable = [
      'nama', 'alamat', 'status', 'slug', 'images'
    ];
}

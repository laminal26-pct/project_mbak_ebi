<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $table = "banks";

    public $primaryKey = "bank_id";

    public $fillable = [
      'nama_bank', 'no_rek', 'atas_nama'
    ];

    public $timestamps = false;
}

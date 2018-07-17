<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kontak extends Model
{
    protected $table = "kontaks";

    public $primaryKey = "kontak_id";

    public $fillable = [
      'nama', 'email', 'telepon', 'alamat', 'pesan', 'read'
    ];

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Konfirmasi extends Model
{
    protected $table = "konfir_bayar";

    public $primaryKey = "bayar_id";

    public $fillable = [
      'bank_id', 'order_id', 'files', 'read'
    ];

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "orders";

    public $primaryKey = "order_id";

    public $fillable = [
      'kode_order', 'kode_unik', 'total', 'nama', 'email', 'telepon', 'alamat', 'status_pembayaran', 'status_pengiriman', 'read'
    ];
}

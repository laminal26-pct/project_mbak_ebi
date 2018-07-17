<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdukOrder extends Model
{
  protected $table = "produk_orders";

  public $primaryKey = "produk_order_id";

  public $fillable = [
    'produk_id', 'order_id', 'jumlah'
  ];

  public $timestamps = false;
}

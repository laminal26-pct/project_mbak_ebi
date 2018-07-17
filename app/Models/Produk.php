<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
  protected $table = "produks";

  public $primaryKey = "produk_id";

  public $fillable = [
    'kategori_produk_id', 'title', 'slug', 'images', 'harga', 'stock', 'description'
  ];

  public function category()
  {
    return $this->hasOne('\App\Models\KategoriProduk','kategori_produk_id','kategori_produk_id');
  }

  public function comment()
  {
    return $this->hasMany('\App\Models\Comment','produk_id','produk_id');
  }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriProduk extends Model
{
    protected $table = "kategori_produks";

    public $primaryKey = "kategori_produk_id";

    public $fillable = [
      'nama_kategori_produk'
    ];

    public $timestamps = false;

    public function product()
    {
      return $this->hasMany('\App\Models\Produk','kategori_produk_id','kategori_produk_id');
    }
}

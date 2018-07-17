<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriBerita extends Model
{
  protected $table = "kategori_beritas";

  public $primaryKey = "kategori_berita_id";

  public $fillable = [
    'nama_kategori_berita'
  ];

  public $timestamps = false;
}

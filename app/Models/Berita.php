<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
  protected $table = "beritas";

  public $primaryKey = "berita_id";

  public $fillable = [
    'user_id', 'kategori_berita_id', 'title', 'slug', 'post_status', 'headline', 'images', 'description'
  ];

  public function category()
  {
    return $this->hasOne('\App\Models\KategoriBerita','kategori_berita_id','kategori_berita_id');
  }
}

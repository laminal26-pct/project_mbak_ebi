<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = "comments";

    public $primaryKey = "comment_id";

    public $fillable = [
      'produk_id','name','email','description', 'read'
    ];

    public function produk()
    {
      return $this->hasOne('\App\Models\Produk','produk_id','produk_id');
    }
}

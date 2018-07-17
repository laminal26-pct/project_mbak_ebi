<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $table = "photos";

    public $primaryKey = "photo_id";

    public $fillable = [
      'album_id', 'image', 'description'
    ];
    
}

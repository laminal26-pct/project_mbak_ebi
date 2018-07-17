<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $table = "albums";

    public $primaryKey = "album_id";

    public $fillable = [
      'name', 'description', 'cover'
    ];

    public function photos()
    {
      return $this->hasMany('App\Models\Photo','album_id','album_id');
    }
}

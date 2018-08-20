<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $table = "videos";

    public $primaryKey = "video_id";

    public $fillable = [
      'title', 'vidoes', 'slug', 'status'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $table = "ratings";

    public $primaryKey = "rating_id";

    public $fillable = [
      'order_id', 'nilai'
    ];

    public $timestamps = false;
    
}

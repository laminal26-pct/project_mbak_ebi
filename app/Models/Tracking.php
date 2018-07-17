<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tracking extends Model
{
    protected $table = "trackings";

    public $primaryKey = "tracking_id";

    public $fillable = [
      'order_id', 'jasa_pengiriman', 'no_resi'
    ];
}

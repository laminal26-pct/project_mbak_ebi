<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    protected $table = "websites";

    public $primaryKey = "website_id";

    public $fillable = [
      'nama_web', 'kategori_website', 'description'
    ];
    
}

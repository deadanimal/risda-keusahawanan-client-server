<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aliran extends Model
{
    use HasFactory;

    public function kategori_aliran()
    {
        return $this->belongsTo(KategoriAliran::class);
    }
}

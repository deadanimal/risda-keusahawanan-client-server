<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriAliran extends Model
{
    use HasFactory;

    public function aliran()
    {
        return $this->hasMany(Aliran::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pekebun extends Model
{
    use HasFactory;

    protected $with = [ 'tanah'];

    public function tanah()
    {
        return $this->hasMany(Tanah::class, 'pekebunid', 'id');
    }
    
}

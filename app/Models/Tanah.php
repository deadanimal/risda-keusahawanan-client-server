<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tanah extends Model
{
    use HasFactory;

    protected $with = [ 'tanaman', 'negeri', 'daerah', 'mukim', 'parlimen', 'parlimen', 'dun', 'kampung', 'seksyen'];

    public function tanaman()
    {
        return $this->hasMany(JenisTanaman::class, 'tanahid', 'id');
    }
    public function negeri()
    {
        return $this->hasOne(Negeri::class, 'U_Negeri_ID', 'U_Negeri_ID');
    }
    public function daerah()
    {
        return $this->hasOne(Daerah::class, 'U_Daerah_ID', 'U_Daerah_ID');
    }
    public function mukim()
    {
        return $this->hasOne(Mukim::class, 'U_Mukim_ID', 'U_Mukim_ID');
    }
    public function parlimen()
    {
        return $this->hasOne(Parlimen::class, 'U_Parlimen_ID', 'U_Parlimen_ID');
    }
    public function dun()
    {
        return $this->hasOne(Dun::class, 'U_Dun_ID', 'U_Dun_ID');
    }
    public function kampung()
    {
        return $this->hasOne(Kampung::class, 'U_Kampung_ID', 'U_Kampung_ID');
    }
    public function seksyen()
    {
        return $this->hasOne(Seksyen::class, 'U_Seksyen_ID', 'U_Seksyen_ID');
    }
}

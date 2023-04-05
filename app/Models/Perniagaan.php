<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perniagaan extends Model
{
    use HasFactory;

    protected $with = ['jenis', 'negeri', 'daerah', 'dun', 'mukim', 'kampung', 'seksyen', 'produk', 'kluster' ];

    /**
     * Get the user associated with the Pegawai
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function jenis()
    {
        return $this->hasOne(JenisPerniagaan::class, 'kod_jenis_perniagaan', 'jenisperniagaan');
    }
    public function negeri()
    {
        return $this->hasOne(Negeri::class, 'U_Negeri_ID', 'U_Negeri_ID');
    }
    public function daerah()
    {
        return $this->hasOne(Daerah::class, 'U_Daerah_ID', 'U_Daerah_ID');
    }
    public function parlimen()
    {
        return $this->hasOne(Parlimen::class, 'U_Parlimen_ID', 'U_Parlimen_ID');
    }
    public function dun()
    {
        return $this->hasOne(Dun::class, 'U_Dun_ID', 'U_Dun_ID');
    }
    public function mukim()
    {
        return $this->hasOne(Mukim::class, 'U_Mukim_ID', 'U_Mukim_ID');
    }
    public function kampung()
    {
        return $this->hasOne(Kampung::class, 'U_Kampung_ID', 'U_Kampung_ID');
    }
    public function seksyen()
    {
        return $this->hasOne(Seksyen::class, 'U_Seksyen_ID', 'U_Seksyen_ID');
    }
    public function produk()
    {
        return $this->hasMany(Produk::class, 'perniagaanid', 'id');
    }
    public function kluster()
    {
        return $this->hasOne(KlusterPerniagaan::class, 'kluster_id', 'klusterperniagaan');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usahawan extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = ['id'];
    // protected $with = ['user','pekebun','negeri','PT','daerah','dun','parlimen','perniagaan','kateusah','syarikat', 'insentif', 'etnik', 'mukim', 'kampung', 'seksyen'];
     
        public function user()
        {
            return $this->hasOne(User::class, 'usahawanid', 'usahawanid');
        }
        public function pekebun()
        {
            return $this->hasOne(Pekebun::class, 'usahawanid', 'usahawanid');
        }
        public function negeri()
        {
            return $this->hasOne(Negeri::class, 'U_Negeri_ID', 'U_Negeri_ID');
        }
        public function PT()
        {
            return $this->hasOne(PusatTanggungjawab::class, 'Kod_PT', 'Kod_PT');
        }
        public function daerah()
        {
            return $this->hasOne(Daerah::class, 'U_Daerah_ID', 'U_Daerah_ID');
        }
        public function dun()
        {
            return $this->hasOne(Dun::class, 'U_Dun_ID', 'U_Dun_ID');
        }
        public function parlimen()
        {
            return $this->hasOne(Parlimen::class, 'U_Parlimen_ID', 'U_Parlimen_ID');
        }
        public function perniagaan()
        {
            return $this->hasOne(Perniagaan::class, 'usahawanid', 'usahawanid');
        }
        public function kateusah()
        {
            return $this->hasOne(KategoriUsahawan::class, 'id_kategori_usahawan', 'id_kategori_usahawan');
        }
        public function syarikat()
        {
            return $this->hasOne(Syarikat::class, 'usahawanid', 'usahawanid');
        }
        public function insentif()
        {
            return $this->hasMany(Insentif::class, 'id_pengguna', 'usahawanid');
        }
        public function etnik()
        {
            return $this->hasOne(Etnik::class, 'U_Etnik_ID', 'U_Etnik_ID');
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
        
        
}

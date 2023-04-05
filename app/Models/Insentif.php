<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insentif extends Model
{
    use HasFactory;

    protected $with = ['jenis'];

    /**
         * Get the user associated with the Pegawai
         *
         * @return \Illuminate\Database\Eloquent\Relations\HasOne
         */
        public function jenis()
        {
            return $this->hasOne(JenisInsentif::class, 'id_jenis_insentif', 'id_jenis_insentif');
        }
}

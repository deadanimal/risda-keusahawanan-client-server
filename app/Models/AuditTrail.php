<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditTrail extends Model
{
    use HasFactory;


    public function pegawais()
    {
        return $this->hasOne(Pegawai::class,'id','idpegawai');
    }
}

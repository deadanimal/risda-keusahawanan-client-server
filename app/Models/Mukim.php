<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mukim extends Model
{
    use HasFactory;

    protected $with = ['Negeri', 'Daerah'];


    public function Negeri()
    {
        return $this->hasOne(Negeri::class, 'U_Negeri_ID', 'U_Negeri_ID');
    }
    public function Daerah()
    {
        return $this->hasOne(Daerah::class, 'U_Daerah_ID', 'U_Daerah_ID');
    }
}

<?php

namespace App\Exports;

use App\Models\Aliran;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class BukuTunai implements FromView
{

    protected $id;
    protected $month;
    protected $year;
    function __construct($id, $month, $year)
    {
        $this->id = $id;
        $this->month = $month;
        $this->year = $year;
    }

    public function view(): View
    {

        $user_id = $this->id;
        $aliran = Aliran::where('id_pengguna', $this->id)
        ->whereMonth('tarikh_aliran', '=', $this->month)
        ->whereYear('tarikh_aliran', '=', $this->year)
        ->get();

        foreach ($aliran as $a) {
            $T = $a->tarikh_aliran;
            $n = explode(' ',$T);
            $new = $n[1].' '.$n[0].' '.$n[2];

            $a['newTarikh'] = $new;
        }

        // dd($aliran);

        // dd($user);
        return view('excel.buku-tunai', [
            'alirans' => $aliran,
            'id' => $user_id,
            'bulan' => $this->month,
            'tahun' => $this->year
        ]);
    }
}

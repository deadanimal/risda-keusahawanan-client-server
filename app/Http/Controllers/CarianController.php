<?php

namespace App\Http\Controllers;

use App\Models\Aliran;
use App\Models\Usahawan;
use App\Models\User;
use Illuminate\Http\Request;

use PDF;

class CarianController extends Controller
{


    public function carianUsahawan($input)
    {

        $usahawan = Usahawan::where('nokadpengenalan', $input)
            ->orWhere('namausahawan', $input)
            ->orWhere('usahawanid', $input)
            ->get();

        return response()->json($usahawan);
    }

    public function downloadCarian($id)
    {

        $usahawan = Usahawan::where('usahawanid', $id)
            ->get()->first();

        // dd($usahawan); 
        $user = User::where('usahawanid', $id)->get()->first();

        $id = $user->id;
        $month = date('m');
        $year = date('Y');


        $user_id = $id;


        $aliran = Aliran::where('id_pengguna', $user_id)
            ->whereMonth('tarikh_aliran', '=', $month)
            ->whereYear('tarikh_aliran', '=', $year)
            ->get();


        $jualan_perolehan = 0;
        $deposit_jualan = 0;
        $pulangan_belian = 0;
        $stok_akhir = 0;

        $hasil_sewaan = 0;
        $hasil_dividen = 0;
        $hasil_komisen = 0;
        $hasil_lain = 0;

        $belian = 0;
        $deposit_belian = 0;
        $pulangan_jualan = 0;
        $stok_awal = 0;
        $kos_pengeposan = 0;

        $kos_alat_tulis = 0;
        $bayaran_sewa = 0;
        $upah_gaji_pekerja = 0;
        $upah_gaji_sendiri = 0;
        $kwsp_socso = 0;

        $bayaran_bil = 0;
        $petrol_tol_parking = 0;
        $penyelenggaraan = 0;
        $belian_aset = 0;
        $bayaran_komisen = 0;
        $cukai_zakat = 0;
        $bayaran_lain = 0;

        // dd($aliran);

        foreach ($aliran as $aliranTemp) {

            if ($aliranTemp->id_kategori_aliran == 1) {
                $jualan_perolehan += $aliranTemp->jumlah_aliran;
            } else if ($aliranTemp->id_kategori_aliran == 2) {
                $deposit_jualan += $aliranTemp->jumlah_aliran;
            } else if ($aliranTemp->id_kategori_aliran == 3) {
                $pulangan_belian += $aliranTemp->jumlah_aliran;
            } else if ($aliranTemp->id_kategori_aliran == 4) {
                $stok_akhir += $aliranTemp->jumlah_aliran;
            } else if ($aliranTemp->id_kategori_aliran == 5) {
                $hasil_sewaan += $aliranTemp->jumlah_aliran;
            } else if ($aliranTemp->id_kategori_aliran == 6) {
                $hasil_dividen += $aliranTemp->jumlah_aliran;
            } else if ($aliranTemp->id_kategori_aliran == 7) {
                $hasil_komisen += $aliranTemp->jumlah_aliran;
            } else if ($aliranTemp->id_kategori_aliran == 8) {
                $hasil_lain += $aliranTemp->jumlah_aliran;
            } else if ($aliranTemp->id_kategori_aliran == 9) {
                $belian += $aliranTemp->jumlah_aliran;
            } else if ($aliranTemp->id_kategori_aliran == 10) {
                $deposit_belian += $aliranTemp->jumlah_aliran;
            } else if ($aliranTemp->id_kategori_aliran == 11) {
                $pulangan_jualan += $aliranTemp->jumlah_aliran;
            } else if ($aliranTemp->id_kategori_aliran == 12) {
                $stok_awal += $aliranTemp->jumlah_aliran;
            } else if ($aliranTemp->id_kategori_aliran == 13) {
                $kos_pengeposan += $aliranTemp->jumlah_aliran;
            } else if ($aliranTemp->id_kategori_aliran == 14) {
                $kos_alat_tulis += $aliranTemp->jumlah_aliran;
            } else if ($aliranTemp->id_kategori_aliran == 15) {
                $bayaran_sewa += $aliranTemp->jumlah_aliran;
            } else if ($aliranTemp->id_kategori_aliran == 16) {
                $upah_gaji_pekerja += $aliranTemp->jumlah_aliran;
            } else if ($aliranTemp->id_kategori_aliran == 17) {
                $upah_gaji_sendiri += $aliranTemp->jumlah_aliran;
            } else if ($aliranTemp->id_kategori_aliran == 18) {
                $kwsp_socso += $aliranTemp->jumlah_aliran;
            } else if ($aliranTemp->id_kategori_aliran == 19) {
                $bayaran_bil += $aliranTemp->jumlah_aliran;
            } else if ($aliranTemp->id_kategori_aliran == 20) {
                $petrol_tol_parking += $aliranTemp->jumlah_aliran;
            } else if ($aliranTemp->id_kategori_aliran == 21) {
                $penyelenggaraan += $aliranTemp->jumlah_aliran;
            } else if ($aliranTemp->id_kategori_aliran == 22) {
                $belian_aset += $aliranTemp->jumlah_aliran;
            } else if ($aliranTemp->id_kategori_aliran == 23) {
                $bayaran_komisen += $aliranTemp->jumlah_aliran;
            } else if ($aliranTemp->id_kategori_aliran == 24) {
                $cukai_zakat += $aliranTemp->jumlah_aliran;
            } else if ($aliranTemp->id_kategori_aliran == 26) {
                $bayaran_lain += $aliranTemp->jumlah_aliran;
            }
        }


        $pdf = PDF::loadView('pdf.maklumat_usahawan', [
            'usahawan' => $usahawan,

            'id' => $user_id,
            'bulan' => $month,
            'tahun' => $year,


            'jualan_perolehan' => $jualan_perolehan,
            'deposit_jualan' => $deposit_jualan,
            'pulangan_jualan' => $pulangan_jualan,
            'stok_awal' => $stok_awal,
            'deposit_belian' => $deposit_belian,
            'belian' => $belian,
            'pulangan_belian' => $pulangan_belian,
            'stok_akhir' => $stok_akhir,

            'kos_pengeposan' => $kos_pengeposan,
            'kos_alat_tulis' => $kos_alat_tulis,
            'bayaran_sewa' => $bayaran_sewa,
            'upah_gaji_pekerja' => $upah_gaji_pekerja,
            'upah_gaji_sendiri' => $upah_gaji_sendiri,
            'kwsp_socso' => $kwsp_socso,
            'bayaran_bil' => $bayaran_bil,
            'petrol_tol_parking' => $petrol_tol_parking,
            'penyelenggaraan' => $penyelenggaraan,
            'belian_aset' => $belian_aset,
            'bayaran_komisen' => $bayaran_komisen,
            'cukai_zakat' => $cukai_zakat,
            'bayaran_lain' => $bayaran_lain,

            'hasil_komisen' => $hasil_komisen,
            'hasil_dividen' => $hasil_dividen,
            'hasil_sewaan' => $hasil_sewaan,
            'hasil_lain' => $hasil_lain,
        ]);


        // return $pdf->stream('result.pdf', array('Attachment'=>0));  

        $fname = time() . '-maklumat-usahawan-' . $id . '.pdf';

        \Storage::put('maklumat-usahawan/' . $fname, $pdf->output());

        // // dd($file);

        return response()->json("maklumat-usahawan/" . $fname);
    }

    public function CariUsahawan(Request $request){


        // return response()->json($request);
        // return $request->all();
        $users = Usahawan::without(['PT','daerah','dun','parlimen','kateusah','syarikat','etnik','mukim','kampung','seksyen','insentif', 'perniagaan', 'pekebun', 'user', 'negeri']);

        if(!empty($request->nama)){
            $users->where('namausahawan', 'like', '%'.$request->nama.'%');
        }
        if(!empty($request->noKP)){
            $users->where('nokadpengenalan', 'like', '%'.$request->noKP.'%');
        }
        if(!empty($request->negeri)){
            $users->where('U_Negeri_ID', $request->negeri);
        }
        if(!empty($request->PT)){
            $users->where('Kod_PT', $request->PT);
        }

        $users->select('namausahawan', 'nokadpengenalan', 'usahawanid','U_Negeri_ID','Kod_PT');
        
        $result = $users->paginate(15);

        return response()->json($result);
       
    }
}

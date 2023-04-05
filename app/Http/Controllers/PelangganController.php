<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Stok;
use App\Models\Katalog;
use App\Models\Usahawan;
// use Doctrine\DBAL\Driver\Mysqli\Initializer\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Facades\Excel;

use PDF;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\Date;

class PelangganController extends Controller
{

    public function index()
    {
        $pelanggan = Pelanggan::all();
        return response()->json($pelanggan);
    }

    public function store(Request $request)
    {
        $pelanggan = new Pelanggan();

        $pelanggan->tajuk = $request->tajuk;
        $pelanggan->nama_pelanggan = $request->nama_pelanggan;
        $pelanggan->alamat1 = $request->alamat1;
        $pelanggan->alamat2 = $request->alamat2;
        $pelanggan->alamat3 = $request->alamat3;
        $pelanggan->poskod = $request->poskod;
        $pelanggan->U_Negeri_ID = $request->U_Negeri_ID;
        $pelanggan->U_Daerah_ID = $request->U_Daerah_ID;
        $pelanggan->no_telefon = $request->no_telefon;
        $pelanggan->no_fax = $request->no_fax;

        $pelanggan->cukai_sst = $request->cukai_sst;
        $pelanggan->kos_penghantaran = $request->kos_penghantaran;
        $pelanggan->diskaun = $request->diskaun;

        $pelanggan->save();

        return response()->json($pelanggan);
    }


    public function show($id)
    {
        // $pelanggan = DB::table('stoks')
        //     ->join('katalogs', 'katalogs.id', 'stoks.id_katalog')
        //     ->join('pelanggans', 'stoks.id_pelanggan', 'pelanggans.id')
        //     ->select('pelanggans.*', 'stoks.id', 'stoks.id_pelanggan')
        //     ->where('id_pengguna', $id)->distinct()
        //     ->get();

        $pelanggan = DB::table('katalogs')
            ->where('katalogs.id_pengguna', $id)
            ->join('stoks', 'stoks.id_katalog', 'katalogs.id')
            ->join('pelanggans', 'stoks.id_pelanggan', 'pelanggans.id')
            ->select('pelanggans.*', 'stoks.id_pelanggan')
            ->distinct()
            ->orderBy('updated_at', 'desc')
            ->get();


        // dd($pelanggan);

        return response()->json($pelanggan);
    }

    public function update(Request $request, Pelanggan $pelanggan)
    {
        $pelanggan->tajuk = $request->tajuk;
        $pelanggan->nama_pelanggan = $request->nama_pelanggan;
        $pelanggan->alamat1 = $request->alamat1;
        $pelanggan->alamat2 = $request->alamat2;
        $pelanggan->alamat3 = $request->alamat3;
        $pelanggan->poskod = $request->poskod;
        $pelanggan->U_Negeri_ID = $request->U_Negeri_ID;
        $pelanggan->U_Daerah_ID = $request->U_Daerah_ID;
        $pelanggan->no_telefon = $request->no_telefon;
        $pelanggan->no_fax = $request->no_fax;

        $pelanggan->cukai_sst = $request->cukai_sst;
        $pelanggan->kos_penghantaran = $request->kos_penghantaran;
        $pelanggan->diskaun = $request->diskaun;

        $pelanggan->save();

        return response()->json($pelanggan);
    }


    public function destroy(Pelanggan $pelanggan)
    {
        $pelanggan->delete();

        return response()->json($pelanggan);
    }


    public function janaDokumen($id, Request $request)
    {

        $data = DB::table('users')->where('users.id', $request->id_pengguna)
            ->join('usahawans', 'usahawans.usahawanid', 'users.usahawanid')
            ->join('syarikats', 'syarikats.usahawanid', 'usahawans.usahawanid')
            ->select(
                'syarikats.logo_syarikat as logo_syarikat',
                'syarikats.nodaftarssm',

                'syarikats.alamat1_ssm as alamat1',
                'syarikats.alamat2_ssm as alamat2',
                'syarikats.alamat3_ssm as alamat3',
                'syarikats.prefix_id',
                'syarikats.nama_akaun_bank',
                'syarikats.no_akaun_bank',
            )
            ->get()->first();

        
        

        $pelanggan = DB::table('pelanggans')
            ->where('pelanggans.id', $id)
            ->join('negeris', 'negeris.U_Negeri_ID', 'pelanggans.U_Negeri_ID')
            ->select(
                'pelanggans.nama_pelanggan',
                'pelanggans.alamat1',
                'pelanggans.alamat2',
                'pelanggans.alamat3',
                'pelanggans.poskod',
                'negeris.Negeri',

                'pelanggans.no_telefon',
                'pelanggans.no_fax',
                'pelanggans.cukai_sst',
                'pelanggans.kos_penghantaran',
                'pelanggans.diskaun',
                'pelanggans.id',
                'pelanggans.tajuk',
            )
            ->get()->first();



        $stok = DB::table('stoks')
            ->where('stoks.id_pelanggan', $id)
            ->join('katalogs', 'katalogs.id', 'stoks.id_katalog')
            ->get();
        

        $today = date("d/m/Y");
        $year = date("Y");


        // $pdff = new Dompdf();
        // $options = new Options();
        // $options->set('isHtml5ParserEnabled', true);
        // $options->set('isRemoteEnabled', true);
        // $pdff->setOptions($options);
        // $pdff->loadHtml(view('pdf.jana_dokumen', [
        //     'today' => $today,
        //     "year" => $year,
        //     'stoks' => $stok,
        //     'data' => $data,
        //     'pelanggan' => $pelanggan,

        //     // 'no_dpa' => $no_dpa
        // ]));
        // $customPaper = array(2, -35, 480, 627);
        // $pdff->setPaper($customPaper);
        // $pdff->render();
        // $pdff->stream(
        //     "newdompdf",
        //     array("Attachment" => false)
        // );

        // exit(0);

        $pdf = PDF::loadView('pdf.jana_dokumen', [
            'today' => $today,
            "year" => $year,
            'stoks' => $stok,
            'data' => $data,
            'pelanggan' => $pelanggan,
        ]);

        $fname = time() . "_dokumenPenuh_" . $pelanggan->nama_pelanggan . ".pdf";


        \Storage::put('jana_dokumen/' . $fname, $pdf->output());
        // file_put_contents(, $output);

        return response()->json('jana_dokumen/' . $fname);
    }

    public function janaQuotation($id, Request $request)
    {
       

        $data = DB::table('users')->where('users.id', $request->id_pengguna)
            ->join('usahawans', 'usahawans.usahawanid', 'users.usahawanid')
            ->join('syarikats', 'syarikats.usahawanid', 'usahawans.usahawanid')
            ->select(
                'syarikats.logo_syarikat as logo_syarikat',
                'syarikats.nodaftarssm',

                'syarikats.alamat1_ssm as alamat1',
                'syarikats.alamat2_ssm as alamat2',
                'syarikats.alamat3_ssm as alamat3',
                'syarikats.prefix_id',
                'syarikats.nama_akaun_bank',
                'syarikats.no_akaun_bank',
            )
            ->get()->first();

        $pelanggan = DB::table('pelanggans')
            ->where('pelanggans.id', $id)
            ->join('negeris', 'negeris.U_Negeri_ID', 'pelanggans.U_Negeri_ID')
            ->select(
                'pelanggans.nama_pelanggan',
                'pelanggans.alamat1',
                'pelanggans.alamat2',
                'pelanggans.alamat3',
                'pelanggans.poskod',
                'negeris.Negeri',

                'pelanggans.no_telefon',
                'pelanggans.no_fax',
                'pelanggans.cukai_sst',
                'pelanggans.kos_penghantaran',
                'pelanggans.diskaun',
                'pelanggans.id',
                'pelanggans.tajuk',
            )
            ->get()->first();

        $stok = DB::table('stoks')
            ->where('stoks.id_pelanggan', $id)
            ->join('katalogs', 'katalogs.id', 'stoks.id_katalog')
            ->get();
        

        $today = date("d/m/Y");
        $year = date("Y");


        $pdf = PDF::loadView('pdf.quotation', [
            'today' => $today,
            "year" => $year,
            'stoks' => $stok,
            'data' => $data,
            'pelanggan' => $pelanggan,
        ]);

        $fname = time() . "_quotation_" . $pelanggan->nama_pelanggan . ".pdf";
       
        // return $pdf->stream($fname, array('Attachment'=>0));

        \Storage::put('jana_dokumen/' . $fname, $pdf->output());

        return response()->json('jana_dokumen/' . $fname);
    }


    public function janaDO($id, Request $request)
    {
       

        $data = DB::table('users')->where('users.id', $request->id_pengguna)
            ->join('usahawans', 'usahawans.usahawanid', 'users.usahawanid')
            ->join('syarikats', 'syarikats.usahawanid', 'usahawans.usahawanid')
            ->select(
                'syarikats.logo_syarikat as logo_syarikat',
                'syarikats.nodaftarssm',

                'syarikats.alamat1_ssm as alamat1',
                'syarikats.alamat2_ssm as alamat2',
                'syarikats.alamat3_ssm as alamat3',
                'syarikats.prefix_id',
                'syarikats.nama_akaun_bank',
                'syarikats.no_akaun_bank',
            )
            ->get()->first();

        $pelanggan = DB::table('pelanggans')
            ->where('pelanggans.id', $id)
            ->join('negeris', 'negeris.U_Negeri_ID', 'pelanggans.U_Negeri_ID')
            ->select(
                'pelanggans.nama_pelanggan',
                'pelanggans.alamat1',
                'pelanggans.alamat2',
                'pelanggans.alamat3',
                'pelanggans.poskod',
                'negeris.Negeri',

                'pelanggans.no_telefon',
                'pelanggans.no_fax',
                'pelanggans.cukai_sst',
                'pelanggans.kos_penghantaran',
                'pelanggans.diskaun',
                'pelanggans.id',
                'pelanggans.tajuk',
            )
            ->get()->first();

        $stok = DB::table('stoks')
            ->where('stoks.id_pelanggan', $id)
            ->join('katalogs', 'katalogs.id', 'stoks.id_katalog')
            ->get();
        

        $today = date("d/m/Y");
        $year = date("Y");


        $pdf = PDF::loadView('pdf.do', [
            'today' => $today,
            "year" => $year,
            'stoks' => $stok,
            'data' => $data,
            'pelanggan' => $pelanggan,
        ]);

        $fname = time() . "_do_" . $pelanggan->nama_pelanggan . ".pdf";
       
        // return $pdf->stream($fname, array('Attachment'=>0));

        \Storage::put('jana_dokumen/' . $fname, $pdf->output());

        return response()->json('jana_dokumen/' . $fname);
    }

    public function janaInvoice($id, Request $request)
    {
        
        $data = DB::table('users')->where('users.id', $request->id_pengguna)
            ->join('usahawans', 'usahawans.usahawanid', 'users.usahawanid')
            ->join('syarikats', 'syarikats.usahawanid', 'usahawans.usahawanid')
            ->select(
                'syarikats.logo_syarikat as logo_syarikat',
                'syarikats.nodaftarssm',

                'syarikats.alamat1_ssm as alamat1',
                'syarikats.alamat2_ssm as alamat2',
                'syarikats.alamat3_ssm as alamat3',
                'syarikats.prefix_id',
                'syarikats.nama_akaun_bank',
                'syarikats.no_akaun_bank',
            )
            ->get()->first();

        $pelanggan = DB::table('pelanggans')
            ->where('pelanggans.id', $id)
            ->join('negeris', 'negeris.U_Negeri_ID', 'pelanggans.U_Negeri_ID')
            ->select(
                'pelanggans.nama_pelanggan',
                'pelanggans.alamat1',
                'pelanggans.alamat2',
                'pelanggans.alamat3',
                'pelanggans.poskod',
                'negeris.Negeri',

                'pelanggans.no_telefon',
                'pelanggans.no_fax',
                'pelanggans.cukai_sst',
                'pelanggans.kos_penghantaran',
                'pelanggans.diskaun',
                'pelanggans.id',
                'pelanggans.tajuk',
            )
            ->get()->first();

        $stok = DB::table('stoks')
            ->where('stoks.id_pelanggan', $id)
            ->join('katalogs', 'katalogs.id', 'stoks.id_katalog')
            ->get();
        

        $today = date("d/m/Y");
        $year = date("Y");


        $pdf = PDF::loadView('pdf.invoice', [
            'today' => $today,
            "year" => $year,
            'stoks' => $stok,
            'data' => $data,
            'pelanggan' => $pelanggan,
        ]);

        $fname = time() . "_invoice_" . $pelanggan->nama_pelanggan . ".pdf";
       
        // return $pdf->stream($fname, array('Attachment'=>0));

        \Storage::put('jana_dokumen/' . $fname, $pdf->output());

        return response()->json('jana_dokumen/' . $fname);
    }
}

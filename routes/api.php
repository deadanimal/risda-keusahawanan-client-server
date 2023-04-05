<?php

use App\Http\Controllers\AliranController;
use App\Http\Controllers\BuletinController;
use App\Http\Controllers\CarianController;
use App\Http\Controllers\DaerahController;
use App\Http\Controllers\DunController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\InsentifController;
use App\Http\Controllers\JenisInsentifController;
use App\Http\Controllers\KampungController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\KategoriAliranController;
use App\Http\Controllers\KategoriUsahawanController;
use App\Http\Controllers\KlusterPerniagaanController;
use App\Http\Controllers\LawatanController;
use App\Http\Controllers\MukimController;
use App\Http\Controllers\NegeriController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\ParlimenController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PekebunController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PerniagaanController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PTController;
use App\Http\Controllers\SeksyenController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\SyarikatController;
use App\Http\Controllers\TanahController;
use App\Http\Controllers\TanamanController;
use App\Http\Controllers\TindakanLawatanController;
use App\Http\Controllers\UsahawanController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::apiResource('user', UserController::class);
Route::apiResource('usahawan', UsahawanController::class);
Route::apiResource('pegawai', PegawaiController::class);

Route::apiResource('pekebun', PekebunController::class);
Route::get('pekebun/getPekebunEspek/{id}', [PekebunController::class, 'getPekebunEspek']);
Route::get('pekebun/getNoTS/{id}', [PekebunController::class, 'getNoTS']);

Route::apiResource('tanah', TanahController::class);
Route::apiResource('tanaman', TanamanController::class);

Route::apiResource('jenis_insentif', JenisInsentifController::class);

Route::apiResource('syarikat', SyarikatController::class);
Route::apiResource('perniagaan', PerniagaanController::class);
Route::apiResource('kategori_aliran', KategoriAliranController::class);

Route::apiResource('aliran', AliranController::class);
Route::post('aliran/uploadDoc/{id}', [AliranController::class, 'uploadDoc']);
Route::get('aliran/getYear/{id}', [AliranController::class, 'getCurrentYearData']);
Route::get('aliran/getMonth/{id}', [AliranController::class, 'getCurrentMonthData']);

Route::apiResource('katalog', KatalogController::class);
Route::get('katalogdashboard', [KatalogController::class, 'katalogdashboard']);

Route::apiResource('pelanggan', PelangganController::class);

Route::post('pelanggan/janaDokumen/{id}', [PelangganController::class, 'janaDokumen']);
Route::post('pelanggan/janaQuotation/{id}', [PelangganController::class, 'janaQuotation']);
Route::post('pelanggan/janaDO/{id}', [PelangganController::class, 'janaDO']);
Route::post('pelanggan/janaInvoice/{id}', [PelangganController::class, 'janaInvoice']);

Route::apiResource('stok', StokController::class);

Route::apiResource('lawatan', LawatanController::class);
Route::get('lawatan/janaDokumenLawatan/{id}', [LawatanController::class, "janaDokumenLawatan"]);
Route::apiResource('tindakanLawatan', TindakanLawatanController::class);

Route::apiResource('buletin', BuletinController::class);
Route::apiResource('insentif', InsentifController::class);

//produk
Route::apiResource('produk', ProdukController::class);

// datalib
Route::apiResource('daerah', DaerahController::class);
Route::apiResource('negeri', NegeriController::class);
Route::apiResource('mukim', MukimController::class);
Route::apiResource('parlimen', ParlimenController::class);
Route::apiResource('dun', DunController::class);
Route::apiResource('kampung', KampungController::class);
Route::apiResource('seksyen', SeksyenController::class);
Route::apiResource('kategori_usahawan', KategoriUsahawanController::class);

Route::apiResource('pusat_tanggungjawab', PTController::class);
Route::get('pusat_tanggungjawab/senarai_pt_pun_pud/{id}', [PTController::class, 'senaraiPTPunPud']);

// Route::('checkUser', [UserController::class, 'checkUser']);
Route::post('/sanctum/token', function (Request $request) {
    $request->validate([
        'no_kp' => 'required',
        'password' => 'required',
        // 'device_name' => 'required',
    ]);

    $user = User::where('no_kp', $request->no_kp)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    return response()->json($user->createToken($request->no_kp)->plainTextToken);
});

//custom
Route::get('deleteStok/{id}', [StokController::class, 'deleteMany']);

Route::get('/katalogPegawai/{i}', [KatalogController::class, 'showKatalogPegawai']);
Route::get('/pengesahanPegawai/{i}', [KatalogController::class, 'pengesahanPegawai']);
Route::get('/katalog/katalogPdf/{i}', [KatalogController::class, 'katalogPdf']);
Route::get('katalog/showMaklumatUsahawan/{i}', [KatalogController::class, 'showMaklumatUsahawan']);

Route::get('/lawatan/usahawan/{id}', [LawatanController::class, 'showLawatanUsahawan']);
Route::get('/lawatan/updateUsahawan/{id}', [LawatanController::class, 'updateLawatanUsahawan']);
Route::post('/lawatan/updateLaporan/{id}', [LawatanController::class, 'updateLaporan']);
Route::get('/lawatan/senaraiUsahawan/{id}', [LawatanController::class, 'showUsahawanForLawatan']);
Route::post('/lawatan/laporanBaru', [LawatanController::class, 'storeLaporan']);
Route::get('/lawatan/showLaporan/{id}', [LawatanController::class, 'showLaporan']);

//generate excel
Route::post('bukuTunaiExcel', [ExcelController::class, 'bukuTunaiExcel']);
Route::post('bukuTunaiPDF', [ExcelController::class, 'bukuTunaiPdf']);

Route::post('pnlExcel', [ExcelController::class, 'pnlExcel']);
Route::post('pnlPdf', [ExcelController::class, 'pnlPdf']);
Route::post('calcPNL', [ExcelController::class, 'calcPNL']);

Route::post('lejerExcel', [ExcelController::class, 'lejerExcel']);
Route::post('lejerPdf', [ExcelController::class, 'lejerPdf']);

Route::post('forgot-password', [PasswordController::class, 'forgot_user']);
Route::post('update-email-password/{id}', [PasswordController::class, 'updateEmailPassword']);
Route::post('updatePassword/{id}', [PasswordController::class, 'updatePassword']);

Route::get('carian/{i}', [CarianController::class, 'carianUsahawan']);
Route::get('downloadCarian/{i}', [CarianController::class, 'downloadCarian']);

Route::post('cari', [CarianController::class, 'CariUsahawan']);
// Route::get('carii', function(){return view('CariUsahawan');});

//notification
Route::apiResource('notifikasi', NotifikasiController::class);
Route::get('notifikasi/updateStatus/{id}', [NotifikasiController::class, 'updateStatus']);

//kluster perniagaan
Route::apiResource('kluster_perniagaan', KlusterPerniagaanController::class);

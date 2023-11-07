<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

use App\Http\Controllers\RabDesaController;

Auth::routes();

// Base URL.
$baseUrl = env('APP_URL');

// Strip HTTP(s) from base URL string.
if (strpos($baseUrl, 'https://') !== false) {
    $baseUrl = str_replace('https://', '', $baseUrl);
} elseif (strpos($baseUrl, 'http://') !== false) {
    $baseUrl = str_replace('http://', '', $baseUrl);
}

// Public routes.
Route::domain("gis.{$baseUrl}")->group(function () {
    Route::get('/', 'PetaController@index');
});

Route::get('/gis', 'PetaController@index');
Route::get('/gis/login', 'PetaController@loginForm');
Route::post('/gis/login', 'PetaController@login');
Route::get('gis/logout', 'PetaController@logout');

// SIMAK DESA ROUTES //

Route::middleware('auth')->group(function () {
    require_once 'web-front.php';

    Route::prefix('api')->group(function () {
        Route::get('penduduk/{id}/checkPendudukKK', 'PendudukController@checkPendudukKK');
        Route::post('penduduk/{id}/update-pindah-dalam-desa', 'PendudukController@updatePindahDalamDesa');
        Route::get('penduduk/bantuan/{id}', 'BantuanController@dataPeserta')->name("api.pendudukNonBantuan");
        Route::get('penduduk/kelompok/{id_kelompok}', 'KelompokController@pendudukTanpaKelompok')->name('api.pendudukTanpaKelompok');
        Route::get('usulan-rkp', 'RkpDesaController@getUsulan')->name("api.usulan");
        Route::put('update-usulan/{id}', 'RkpDesaController@updateToUsulan');
        Route::delete('rab-usulan/delete/{id}', 'RabDesaController@deleteUraian')->name('api.rab-usulan.delete');
        Route::delete('usulan-kegiatan-dusun/delete/{id}', 'UsulanDusunController@deleteUsulanKegiatan')->name('api.usulan-kegiatan-dusun.delete');
        Route::get('penduduk-pendatang/village', 'PendudukPendatangController@dataVillage')->name("api.villageDuktang");
        Route::get('penduduk-pendatang/anggota', 'PendudukPendatangController@dataPenduduk')->name("api.anggotaDuktang");
        Route::get('kategori-aset', 'KategoriInventarisController@getKategoriAsset')->name("api.kategori-aset");
        Route::post('upload-attachment', 'RkpDesaController@uploadAttachment')->name('api.upload-attachment');
        Route::get('rab-harga-item/{id}','RabDesaController@getItemPrice')->name('api.rab-harga-item');
    });


    //Wilayah
    Route::resource('wilayah', 'WilayahController');

    //Pamong
    Route::resource('pamong', 'PamongController');

    //Kepala Dusun
    Route::resource('kepala-dusun', 'KepalaDusunController');

    //Penduduk
    Route::post('penduduk/export', 'PendudukController@export');
    Route::get('penduduk/template/import', 'PendudukController@templateImport')->name('import-template');
    Route::post('penduduk/template/import', 'PendudukController@import')->name('import');
    Route::resource('penduduk', 'PendudukController');
    Route::get('penduduk/{id}/json', 'PendudukController@toJson');
    Route::get('penduduk-tanpa-kk', 'PendudukController@pendudukTanpaKK');
    Route::post('penduduk/{id}/updateJson', 'PendudukController@updateJson');
    Route::post('penduduk/{id}/pecah-kk', 'PendudukController@pecahKK');
    Route::get('penduduk/{id}/status-dasar', 'PendudukController@statusDasar')->name('penduduk.status-dasar');
    Route::post('penduduk/{id}/update-status-dasar', 'PendudukController@updateStatusDasar')
        ->name('penduduk.update-status-dasar');


    //Keluarga
    Route::resource('keluarga', 'KeluargaController');
    Route::get('keluarga/{id}/anggota', 'KeluargaController@anggota')->name('keluarga.anggota');
    Route::get('keluarga/{id}/json', 'KeluargaController@toJson');
    Route::post('keluarga/{id}/tambah-penduduk', 'KeluargaController@tambahPenduduk');

    Route::get('peta', 'PetaController@index');
    Route::get('peta/filter', 'PetaController@filter');
    Route::get('peta/family', 'PetaController@family');

    // Lokasi
    Route::resource('peta/lokasi', 'LokasiController');
    Route::resource('peta/tipelokasi', 'TipeLokasiController');

    // Area
    Route::resource('peta/area', 'AreaController');
    Route::resource('peta/tipearea', 'TipeAreaController');

    // Garis
    Route::resource('peta/garis', 'GarisController');
    Route::resource('peta/tipegaris', 'TipeGarisController');

    // Bantuan
    Route::resource('bantuan', 'BantuanController');
    Route::get('bantuan/{id}/tambah-peserta', 'BantuanController@tambahPeserta')->name('bantuan.tambah-peserta');
    Route::get('bantuan/{id}/edit/{peserta}', 'BantuanController@editPeserta')->name('bantuan.peserta.edit');
    Route::put('bantuan/{id}/edit/{peserta}', 'BantuanController@updatePeserta')->name('bantuan.peserta.update');
    Route::post('bantuan/{id}/peserta', 'BantuanController@storePeserta')->name('bantuan.peserta.store');
    Route::delete('bantuan/peserta/{id}/{peserta}', 'BantuanController@hapusPeserta');


    //Kelompok
    Route::resource('kelompok', 'KelompokController');




    Route::get('kelompok/{id}/anggota/create', 'KelompokController@tambahAnggota')->name('kelompok.tambah-anggota');
    Route::get('kelompok/{id}/anggota/{anggota}/remove', 'KelompokController@hapusAnggota')->name('kelompok.hapus-anggota');
    Route::post('kelompok/{id}/anggota', 'KelompokController@simpanAnggota')->name('kelompok.anggota.store');
    Route::get('kelompok/{id}/anggota/{anggota}/edit', 'KelompokController@editAnggota')->name('kelompok.anggota.edit');
    Route::post('kelompok/anggota/{anggota}', 'KelompokController@updateAnggota')->name('kelompok.anggota.update');

    Route::get('kategori-kelompok/create', 'KelompokController@createCategory')->name('kategori-kelompok.create');
    Route::post('kategori-kelompok', 'KelompokController@storeCategory')->name('kategori-kelompok.store');

    //kategori kelompok
    Route::resource('kategori-kelompok', 'KategoriKelompokController');

    // Homepage
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/profile', 'ProfileController@edit')->name('profile');
    Route::post('/profile', 'ProfileController@update')->name('profile.update');

    // Statistik
    Route::get('statistik/penduduk', 'StatistikController@penduduk')->name('statistik.penduduk');

    //Suku
    Route::resource('suku', 'SukuController');

    //Surat
    Route::prefix('surat')->group(function () {
        Route::get('permohonan/', 'SuratController@indexRequest');
        Route::get('cetak/', 'SuratController@index');
        Route::get('/', 'SuratController@arsip');
        Route::get('laporan', 'SuratController@recap');
        Route::get('laporan/preview', 'SuratController@recapPreview');
        Route::get('cetak/{jenis}', 'SuratController@create')->name('surat.cetak');
        Route::post('cetak/{jenis}', 'SuratController@store');
        Route::delete('{id}', 'SuratController@destroy')->name('surat.destroy');
        Route::get('cetak/{code}/print', 'SuratController@renderSurat');
        Route::get('{id}', 'SuratController@show')->name('surat.detail');
        Route::get('permohonan/{id}/cetak', 'SuratController@createRequest')->name('surat.permohonan.cetak');
        Route::put('permohonan/{id}/cetak', 'SuratController@update')->name('surat.update');
        Route::get('cetak/{jenis}/print/{id_surat}', 'SuratController@tampilSurat')->name('render.surat');
    });

    //E-planning
    Route::prefix('e-planning')->group(function () {
        Route::resource('bidang', 'BidangEplanningController');
        Route::resource('usulan-desa', 'UsulanDesaController');
        Route::resource('rkp-desa', 'RkpDesaController');
        Route::resource('rab-desa', 'RabDesaController');
        Route::resource('usulan-dusun', 'UsulanDusunController');
        Route::get('download-asset-usulan-dusun/{id}','UsulanDusunController@downloadAsset')->name('asset-usulan-dusun.download');
        Route::resource('barang', 'BarangController');
        Route::resource('kategori-barang', 'KategoriBarangController');

        Route::get('rkp-desa-2', 'RkpDesaController@index2')->name('rkp-desa-2.index');
        Route::get('rkp-desa-2/create', 'RkpDesaController@create2')->name('rkp-desa-2.create');
        Route::post('rkp-desa-2', 'RkpDesaController@store2')->name('rkp-desa-2.store');
        Route::get('rkp-desa-2/{id}/edit', 'RkpDesaController@edit2')->name('rkp-desa-2.edit');
        Route::post('rkp-desa-2/{id}', 'RkpDesaController@update2')->name('rkp-desa-2.update');
        Route::get('rkp-desa-2/{id}', 'RkpDesaController@show2')->name('rkp-desa-2.show');
        Route::delete('rkp-desa-2/{id}', 'RkpDesaController@destroy2')->name('rkp-desa-2.destroy');

        Route::prefix('report')->group( function () {
            Route::get('/rkp-desa/{id}', 'RkpDesaController@reportRkp')->name('report.rkp');
            Route::get('/rab-desa/{id}', 'RabDesaController@reportRab')->name('report.rab');
            Route::get('/usulan-dusun/{id}', 'UsulanDusunController@reportUsulanDusun')->name('report.usulan-dusun');
        });
    });

    //Aset
    Route::prefix('aset/')->group(function () {
        Route::resource('{id}/detail-aset', 'DetailInventarisController');
        Route::get('/', 'InventarisController@index')->name('aset.index');
        Route::resource('/kategori-aset', 'KategoriInventarisController');
        Route::resource('{id}/{id_detail}/log/', 'LogInventarisController', ['as' => 'inventaris-log']);
        Route::get('/{id}/{id_detail}/print-barcode/', 'InventarisBarcodeController@PrintBarcodeDetail')->name('barcode.detail');
        Route::get('/{id}/print-barcode/', 'InventarisBarcodeController@PrintBarcode')->name('barcode.aset');
    });
    Route::resource('aset', 'InventarisController')->except(['index']);

    //Notification
    Route::resource('notification', 'NotificationController');
    Route::get('notification-resend/{id}', 'NotificationController@resend')->name('notification-resend');

    //Pengaduan
    Route::resource('pengaduan/categories', 'PengaduanCategoriesController');
    Route::resource('pengaduan', 'PengaduanController');
    Route::put('tandai-selesai/{pengaduan}', 'PengaduanController@markDone');
    Route::get('pengaduan/{pengaduan}/disposisi', 'PengaduanController@editDisposisi')->name('pengaduan.edit-disposisi');
    Route::put('disposisi/{pengaduan}', 'PengaduanController@disposisi')->name('pengaduan.disposisi');
    Route::post('pengaduan/{id}/comment', 'PengaduanCommentController@store')->name('pengaduan.comment.store');
    Route::delete('comment/{id}', 'PengaduanCommentController@destroy')->name('comment.destroy');

    //Duktang
    Route::resource('penduduk-pendatang', 'PendudukPendatangController');
    Route::resource('anggota-duktang', 'DetailPendudukPendatangController');
    Route::get('penduduk-pendatang/{id}/angggota/create', 'PendudukPendatangController@tambahAnggota')->name('penduduk-pendatang.tambah-angggota');
    Route::post('penduduk-pendatang/{id}/angggota', 'DetailPendudukPendatangController@store')->name('penduduk-pendatang.anggota.store');
    Route::get('penduduk-pendatang/{id}/preview', 'PendudukPendatangController@tambahTandatanganExport')->name('penduduk-pendatang.preview');
    Route::post('penduduk-pendatang/{id}/export', 'PendudukPendatangController@exportDuktang')->name('penduduk-pendatang.export');
    Route::resource('duktang', 'PendudukPendatangController');

    Route::resource('/cctv', 'CctvController');
    Route::get('/desa/edit', 'DesaController@index')->name('desa.edit');
    Route::post('/desa/edit', 'DesaController@update')->name('desa.update');
});

Route::resource('jenis-surat', 'JenisSuratController');

// Stats
Route::get('stat/revenue', 'HomeController@revenue');
Route::get('stat/country', 'HomeController@country');
Route::get('stat/customer', 'HomeController@customer');
Route::get('stat/product', 'HomeController@product');


Route::get('mobile/privacy-policy', function () {
    return view('mobile/privacy_policy');
});



// Home
// Route::get('/',function(){
//     return view('home-menu');
// });

// Users
Route::resource('user', 'UserController')->except(['show']);

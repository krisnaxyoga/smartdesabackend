<?php

use Illuminate\Http\Request;
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

// Auth routes.

Route::post('login', 'Api\AuthController@login');
Route::post('register', 'Api\AuthController@register');

Route::get('legend/filter', 'PetaController@filter');

Route::get('category', 'Api\BaseController@category');

Route::get('cctv/', 'Api\CctvController@index');
Route::get('cctv/{id}', 'Api\CctvController@show');

Route::get('penduduk-kelompok/{id_kelompok}', 'Api\PendudukController@pendudukTanpaKelompok')
    ->name('api.penduduk-kelompok');

Route::get('statistik', 'StatistikController@penduduk');

Route::get('wilayah', 'Api\WilayahController@index');

Route::get('berita', 'Api\BeritaController@index');
Route::get('berita/{slug}', 'Api\BeritaController@show');

Route::get('slider', 'Api\SliderController@index');

Route::get('kelompok', 'Api\KelompokController@index');
Route::get('bantuan', 'Api\BantuanController@index');

Route::get('lokasi', 'Api\LocationController@index');
Route::get('lokasi/category', 'Api\LocationController@category');

Route::get('area', 'Api\AreaController@index');
Route::get('area/category', 'Api\AreaController@category');

Route::get('typology', 'Api\TypologyController@index');
Route::get('typology/category', 'Api\TypologyController@category');

Route::post('kadus/login', 'Api\KepalaDusunController@login');
Route::post('test', 'Api\KepalaDusunController@test');

Route::post('upload-file', 'Api\FileController@store');

Route::namespace('Api')->group(function () {
    Route::middleware('check_kadus')->group(function () {
        Route::get('pengajuan-surat', 'PengajuanSuratController@index');
        Route::get('pengajuan-surat/{id}', 'PengajuanSuratController@show');
        Route::put('pengajuan-surat/{id}/accept', 'PengajuanSuratController@accept');
        Route::put('pengajuan-surat/{id}/reject', 'PengajuanSuratController@reject');
        Route::get('jenis-surat', 'JenisSuratController@index');
        Route::post('kadus/change-password', 'KepalaDusunController@changePassword');
        Route::post('kadus/logout', 'KepalaDusunController@logout');
        Route::get('track', 'PengajuanSuratController@track');
    });

    Route::middleware('check_penduduk')->group(function () {
        Route::get('penduduk/search', 'PendudukController@searchPenduduk');
        Route::get('permohonan', 'PendudukController@daftarSurat');
        Route::put('penduduk/update', 'PendudukController@update');
        Route::get('permohonan/{id}', 'PengajuanSuratController@show');
        Route::post('permohonan', 'PendudukController@ajukanSurat');
        Route::get('jenis-surat', 'JenisSuratController@index');
        Route::post('penduduk/logout', 'PendudukController@logout');
    });

    Route::get('kadus-by-penduduk/{id}', "PendudukController@infoKadus");
    Route::get('penduduk/{id}/detail', "PendudukController@detailPenduduk");
});

Route::get('penduduk', 'Api\PendudukController@index')->name('api.penduduk');
Route::get('penduduk/jeniskelamin', 'Api\PendudukController@sex');
Route::get('penduduk/status', 'Api\PendudukController@status');
Route::get('penduduk/{id}', 'Api\PendudukController@show');
Route::post('penduduk/login', 'Api\PendudukController@login');

Route::middleware('check_desa_header')->group(function () {

    Route::get('notification', 'Api\NotificationController@index')->name('api.notification');

    Route::get('kategori-pengaduan', 'Api\PengaduanCategoriesController@index');
    Route::get('pengaduan', 'Api\PengaduanController@index')->name('api.pengaduan');
    Route::get('pengaduan/{id}', 'Api\PengaduanController@show')->name('api.pengaduan.show');
    Route::get('target-disposisi', 'Api\PengaduanController@targetDisposisi');
    Route::put('disposisi/{pengaduan}', 'Api\PengaduanController@updateDisposisi');

    Route::get('pengaduan/{pengaduan}/comment', 'Api\PengaduanCommentController@comment');
    Route::get('pengaduan/{pengaduan}/comment-publics', 'Api\PengaduanCommentController@commentPublics');

    Route::post('pamong/login', 'Api\PamongController@login');
    Route::middleware('check_staff_desa')->group(function () {

        Route::get('pamong/daftar-pengaduan', 'Api\PamongController@daftarPengaduan');
        Route::post('pengaduan/{pengaduan}/reply-staff', 'Api\PengaduanCommentController@replyByStaff');
        Route::post('pamong/logout', 'Api\PamongController@logout');
    });

    Route::middleware('check_kadus')->group(function () {
        Route::post('pengaduan/{pengaduan}/reply-kadus', 'Api\PengaduanCommentController@replyByKadus');
    });

    Route::middleware('check_penduduk')->group(function () {
        Route::get('pengaduan-penduduk', 'Api\PendudukController@listPengaduan');
        Route::post('penduduk/kirim-pengaduan', 'Api\PendudukController@kirimPengaduan');
        Route::post('penduduk/{pengaduan}/send-comment', 'Api\PendudukController@buatKomentar');
    });
});

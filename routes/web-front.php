<?php

Route::namespace('Web')->group(function(){
    Route::resource('kategori-berita','KategoriController');
    Route::resource('berita','BeritaController');
    Route::resource('slider','SliderController');
    Route::get('sejarah','HalamanController@sejarah');
    Route::get('visimisi','HalamanController@visimisi');
    Route::get('lembaga-desa','HalamanController@lembagaDesa');

    Route::post('sejarah','HalamanController@updateSejarah');
    Route::post('visimisi','HalamanController@updateVisiMisi');
    Route::post('lembaga-desa','HalamanController@updateLembagaDesa');
    

    //Lembaga Masyarakat
    Route::resource('lembaga-masyarakat', 'LembagaMasyarakatController');
    Route::get('remove-img/{tipe}', 'HalamanController@hapusGambar')->name('remove-img');

    //Transparasi Keuangan
    Route::resource('transparasi-keuangan', 'TransparasiKeuanganController');

    //Custom Halaman
    Route::resource('halaman','HalamanTambahanController');
    
});
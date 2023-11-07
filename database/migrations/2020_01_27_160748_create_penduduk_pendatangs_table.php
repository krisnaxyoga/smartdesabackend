<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePendudukPendatangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penduduk_pendatang', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('desa_id');
            $table->string('nik',21);
            $table->string('no_kk')->nullable();
            $table->string('nama');
            $table->integer('sex_id');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->integer('golongan_darah_id');
            $table->integer('agama_id');
            $table->integer('status_kawin_id');
            $table->integer('status_keluarga_id');
            $table->integer('pendidikan_id');
            $table->integer('pekerjaan_id');
            $table->integer('warga_negara_id');
            $table->string('no_hp')->nullable();
            $table->string('email')->nullable();
            $table->integer('status')->nullable();
            $table->string('alasan_domisili');
            $table->string('alamat_asal');
            $table->bigInteger('desa_asal_id');
            $table->integer('dusun_tinggal_id');
            $table->integer('jenis_tempat_tinggal_id');
            $table->string('alamat_tinggal');
            $table->string('photo')->nullable();
            $table->string('photo_ktp')->nullable();
            $table->string('status_verifikasi');
            $table->date('tanggal_melapor');
            $table->string('surat',80);
            $table->string('no_surat_desa')->nullable();
            $table->date('masa_berlaku')->nullable();
            $table->integer('staff_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penduduk_pendatang');
    }
}

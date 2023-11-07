<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuratAnggotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_anggota', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('penduduk_id');
            $table->string('nama');
            $table->string('jenis_kelamin');
            $table->string('umur');
            $table->string('status');
            $table->string('pendidikan');
            $table->string('ktp');
            $table->integer('pengajuan_surat_id');
            $table->integer('keterangan');
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
        Schema::dropIfExists('surat_anggota');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSkmtAdditionalFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pengajuan_surat', function (Blueprint $table) {
            $table->date('tanggal_meninggal')->nullable();
            $table->string('lokasi_meninggal')->nullable();
            $table->string('penyebab_meninggal')->nullable();
            $table->string('nama_pelapor')->nullable();
            $table->string('nik_pelapor')->nullable();
            $table->string('hubungan_pelapor')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pengajuan_surat', function (Blueprint $table) {
            //
        });
    }
}

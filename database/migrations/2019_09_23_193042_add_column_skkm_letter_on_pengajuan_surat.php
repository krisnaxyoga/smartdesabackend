<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnSkkmLetterOnPengajuanSurat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pengajuan_surat', function (Blueprint $table) {
            //
            $table->string('nama_pasangan')->nullable();
            $table->string('tahun_kawin')->nullable();
            $table->string('lokasi_kawin')->nullable();
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
            $table->dropColumn(['nama_pasangan', 'tahun_kawin', 'lokasi_kawin']);

        });
    }
}

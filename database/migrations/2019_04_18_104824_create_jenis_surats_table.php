<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJenisSuratsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jenis_surat', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode_surat');
            $table->string('judul');
            /**
             * Tipe : 
             * 1 - Keperluan
             * 2 - Periode
             * 3 - Jenis Acara
             * 4 - Periode Date Time
             * 5 - Informasi Tempat Usaha (SKTU)
             * 6 - Informasi Keterangan Kawin
             * 7 - Pernyataan Status
             * 7 - 
             * 8 - 
             * 9 - Informasi Surat Keterangan Pindah
             */
            $table->string('tipe');
            $table->boolean('is_mobile');
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
        Schema::dropIfExists('jenis_surat');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailPendudukPendatangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_penduduk_pendatang', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('duktang_id');
            $table->string('nik',23);
            $table->string('nama');
            $table->integer('sex_id');
            $table->date('tanggallahir');
            $table->integer('status_kawin_id');
            $table->integer('pendidikan_id');
            $table->integer('status_keluarga_id');
            $table->string('keterangan')->nullable();
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
        Schema::dropIfExists('detail_penduduk_pendatang');
    }
}

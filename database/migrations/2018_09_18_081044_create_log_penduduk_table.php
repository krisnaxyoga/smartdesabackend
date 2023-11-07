<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogPendudukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_penduduk', function (Blueprint $table) {
            $table->increments('id');
            $table->date('tgl_peristiwa');
            $table->integer('penduduk_id');
            $table->integer('detail_id')->nullable();
            $table->text('catatan');
            $table->string('no_kk',25)->nullable();
            $table->string('nama_kk');
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
        Schema::dropIfExists('log_penduduk');
    }
}

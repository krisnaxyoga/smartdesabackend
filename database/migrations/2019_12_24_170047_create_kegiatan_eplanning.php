<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKegiatanEplanning extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kegiatan_eplanning', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('rkp_id')->nullable();
            $table->integer('desa_id');
            $table->integer('bidang_id')->nullable();
            $table->integer('sub_bidang_id')->nullable();
            $table->integer('wilayah_id')->nullable();
            $table->string('nama_kegiatan');
            $table->string('lokasi')->nullable();
            $table->string('volume');
            $table->string('manfaat');
            $table->date('start_date')->nullable();
            $table->string('estimated_time')->nullable();
            $table->string('attachment')->nullable();
            $table->string('swakelola')->nullable();
            $table->string('kerjasama_antardesa')->nullable();
            $table->string('kerjasama_pihak_ketiga')->nullable();
            $table->bigInteger('jumlah');
            $table->string('sumber_biaya')->nullable();
            $table->text('rencana_pelaksana_kegiatan')->nullable();
            $table->enum('status',['USULAN DESA', 'RKP', 'USULAN DUSUN']);
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
        Schema::dropIfExists('kegiatan_eplanning');
    }
}

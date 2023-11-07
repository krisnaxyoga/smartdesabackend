<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnPenerimaOnKegiatanEplanning extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kegiatan_eplanning', function (Blueprint $table) {
            $table->integer('usulan_dusun_id')->nullable();
            $table->string('satuan')->nullable();
            $table->integer('penerima_lk')->nullable();
            $table->integer('penerima_pr')->nullable();
            $table->integer('penerima_artm')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kegiatan_eplanning', function (Blueprint $table) {
            //
        });
    }
}

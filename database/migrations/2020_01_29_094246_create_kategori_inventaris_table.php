<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKategoriInventarisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kategori_inventaris', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('golongan',11);
            $table->string('bidang',11);
            $table->string('kelompok',11);
            $table->string('sub_kelompok',11);
            $table->string('sub_sub_kelompok',11);
            $table->string('nama_kategori',255);
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
        Schema::dropIfExists('kategori_inventaris');
    }
}

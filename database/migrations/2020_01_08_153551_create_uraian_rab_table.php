<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUraianRabTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uraian_rab', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('desa_id');
            $table->integer('id_rab');
            $table->string('nama_uraian')->nullable();
            $table->enum('kategori_uraian', ['Bahan', 'Alat', 'Upah'])->nullable();
            $table->integer('barang_id')->nullable();
            $table->integer('volume');
            $table->string('satuan');
            $table->integer('harga_satuan');
            $table->bigInteger('jumlah_total');
            $table->text('keterangan');
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
        Schema::dropIfExists('uraian_rab');
    }
}

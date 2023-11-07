<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventarisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventaris', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('desa_id');
            $table->integer('kategori_id');
            $table->string('kode_barang');
            $table->integer('bidang_id');
            $table->year('tahun_perolehan')->nullable();
            $table->integer('stock')->nullable();
            $table->string('harga_perolehan')->nullable();
            $table->integer('sumber_inventaris_id')->nullable();
            $table->string('nama_inventaris');
            $table->string('merk')->nullable();
            $table->string('no_sertifikat')->nullable();
            $table->string('bahan')->nullable();
            $table->integer('unit_id')->nullable();
            $table->text('keterangan')->nullable();
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
        Schema::dropIfExists('inventaris');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePengajuanSuratsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengajuan_surat', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('desa_id');
            $table->integer('dusun_id');
            $table->text('keperluan');
            $table->text('keterangan')->nullable();
            $table->integer('penduduk_id');
            $table->integer('jenis_surat_id');
            $table->string('nomor_surat')->nullable();
            $table->string('jenis_acara')->nullable();
            $table->date('berlaku_dari')->nullable();
            $table->date('berlaku_sampai')->nullable();
            $table->string('staff_id')->nullable();
            $table->string('staff_sebagai_id')->nullable();
            $table->string('no_surat_pengantar')->nullable();
            $table->string('status');
            $table->boolean('is_mobile')->default(false)->nullable();
            $table->date('tanggal_pengajuan')->nullable();
            $table->date('tanggal_verifikasi')->nullable();
            $table->date('tanggal_cetak')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengajuan_surat');
    }
}

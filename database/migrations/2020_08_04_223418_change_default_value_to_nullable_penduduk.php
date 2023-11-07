<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeDefaultValueToNullablePenduduk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('penduduk', function (Blueprint $table) {
            //
            $table->integer('id_kk')->nullable()->change();
            $table->integer('kk_level')->nullable()->change();
            $table->integer('id_rtm')->nullable()->change();
            $table->integer('rtm_level')->nullable()->change();
            $table->integer('sex')->nullable()->change();
            $table->string('tempatlahir')->nullable()->change();
            $table->date('tanggallahir')->nullable()->change();
            $table->integer('agama_id')->nullable()->change();
            $table->integer('pendidikan_kk_id')->nullable()->change();
            $table->integer('pendidikan_sedang_id')->nullable()->change();
            $table->integer('pekerjaan_id')->nullable()->change();
            $table->integer('status_kawin_id')->nullable()->change();
            $table->integer('warganegara_id')->nullable()->change();
            $table->string('dokumen_paspor')->nullable()->change();
            $table->string('dokumen_kitas')->nullable()->change();
            $table->string('ayah_nik')->nullable()->change();
            $table->string('ibu_nik')->nullable()->change();
            $table->string('nama_ayah')->nullable()->change();
            $table->string('nama_ibu')->nullable()->change();
            $table->string('foto')->nullable()->change();
            $table->integer('golongan_darah_id')->nullable()->change();
            $table->integer('dusun_id')->nullable()->change();
            $table->integer('status')->nullable()->change();
            $table->string('alamat_sebelumnya',200)->nullable()->change();
            $table->string('alamat_sekarang',200)->nullable()->change();
            $table->integer('status_dasar')->nullable()->change();
            $table->integer('hamil')->nullable()->change();
            $table->integer('cacat_id')->nullable()->change();
            $table->integer('sakit_menahun_id')->nullable()->change();
            $table->string('akta_lahir')->nullable()->change();
            $table->string('akta_perkawinan')->nullable()->change();
            $table->date('tanggalperkawinan')->nullable()->change();
            $table->string('akta_perceraian')->nullable()->change();
            $table->date('tanggalperceraian')->nullable()->change();
            $table->integer('cara_kb_id')->nullable()->change();
            $table->string('telepon')->nullable()->change();
            $table->date('tanggal_akhir_paspor')->nullable()->change();
            $table->string('no_kk_sebelumnya')->nullable()->change();
            $table->integer('ktp_el')->nullable()->change();
            $table->integer('status_rekam_id')->nullable()->change();
            $table->string('waktu_lahir')->nullable()->change();
            $table->integer('tempat_dilahirkan_id')->nullable()->change();
            $table->integer('jenis_kelahiran_id')->nullable()->change();
            $table->integer('kelahiran_anak_ke')->nullable()->change();
            $table->integer('penolong_kelahiran_id')->nullable()->change();
            $table->string('berat_lahir')->nullable()->change();
            $table->string('panjang_lahir')->nullable()->change();
            $table->integer('suku_id')->nullable()->change();
            $table->string('job_description')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('penduduk', function (Blueprint $table) {
            //
        });
    }
}

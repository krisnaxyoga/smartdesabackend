<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePendudukTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('penduduk', function(Blueprint $table)
		{
            $table->increments('id');
            $table->integer('desa_id');
			$table->string('nama', 100);
			$table->char('nik', 20);
			$table->integer('id_kk')->nullable()->default(0);
			$table->integer('kk_level')->default(0);
			$table->integer('id_rtm');
			$table->integer('rtm_level');
			$table->integer('sex')->nullable();
			$table->string('tempatlahir', 100);
			$table->date('tanggallahir')->nullable();
			$table->integer('agama_id')->unsigned();
			$table->integer('pendidikan_kk_id')->unsigned();
			$table->integer('pendidikan_sedang_id')->unsigned();
			$table->integer('pekerjaan_id')->unsigned();
			$table->integer('status_kawin_id');
			$table->integer('warganegara_id')->unsigned();
			$table->string('dokumen_paspor', 45)->nullable();
			$table->integer('dokumen_kitas')->nullable();
			$table->string('ayah_nik', 20);
			$table->string('ibu_nik', 20);
			$table->string('nama_ayah', 100);
			$table->string('nama_ibu', 100);
			$table->string('foto', 255);
			$table->integer('golongan_darah_id');
			$table->integer('dusun_id');
			$table->integer('status')->unsigned()->nullable();
			$table->string('alamat_sebelumnya', 200);
			$table->string('alamat_sekarang', 200);
			$table->integer('status_dasar')->default(1);
			$table->integer('hamil')->nullable();
			$table->integer('cacat_id')->nullable();
			$table->integer('sakit_menahun_id')->nullable();
			$table->string('akta_lahir', 40)->nullable();
			$table->string('akta_perkawinan', 40)->nullable();
			$table->date('tanggalperkawinan')->nullable();
			$table->string('akta_perceraian', 40)->nullable();
			$table->date('tanggalperceraian')->nullable();
			$table->integer('cara_kb_id')->nullable();
			$table->string('telepon', 20)->nullable();
			$table->date('tanggal_akhir_paspor')->nullable();
			$table->string('no_kk_sebelumnya', 30)->nullable();
			$table->integer('ktp_el');
			$table->integer('status_rekam_id')->default(0);
			$table->string('waktu_lahir', 5);
			$table->integer('tempat_dilahirkan_id');
			$table->integer('jenis_kelahiran_id');
			$table->integer('kelahiran_anak_ke');
			$table->integer('penolong_kelahiran_id');
			$table->string('berat_lahir', 10);
			$table->string('panjang_lahir', 10);
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
		Schema::drop('penduduk');
	}

}

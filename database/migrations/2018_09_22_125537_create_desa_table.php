<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDesaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('desa', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nama_desa', 100);
			$table->string('kode_desa', 100);
			$table->string('nama_kepala_desa', 100);
			$table->string('nip_kepala_desa', 100);
            $table->string('kode_pos', 6);
            $table->string('kode_village', 20);
			$table->string('nama_kecamatan', 100);
			$table->string('kode_kecamatan', 100);
			$table->string('nama_kepala_camat', 100);
			$table->string('nip_kepala_camat', 100);
			$table->string('nama_kabupaten', 100);
			$table->string('kode_kabupaten', 100);
			$table->string('nama_propinsi', 100);
			$table->string('kode_propinsi', 100);
			$table->text('logo', 65535);
			$table->string('lat', 20);
			$table->string('lng', 20);
			$table->boolean('zoom');
			$table->string('map_tipe', 20);
			$table->text('path', 65535);
			$table->string('alamat_kantor', 200)->nullable();
			$table->string('g_analytic', 200);
			$table->string('email_desa', 50)->nullable();
			$table->string('telepon', 50)->nullable();
            $table->string('website', 100)->nullable();
            $table->string('akronim', 120)->nullable();
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
		Schema::drop('desa');
	}

}

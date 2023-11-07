<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateKeluargaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('keluarga', function(Blueprint $table)
		{
            $table->increments('id');
            $table->integer('desa_id');
			$table->string('no_kk', 160)->nullable();
			$table->string('nik_kepala', 200)->nullable()->index('nik_kepala');
			$table->timestamp('tgl_daftar')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->integer('kelas_sosial')->nullable();
			$table->dateTime('tgl_cetak_kk')->nullable();
			$table->string('alamat', 200)->nullable();
            $table->integer('id_cluster')->nullable();
            $table->string('lat', 24)->nullable();
			$table->string('lng', 24)->nullable();
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
		Schema::drop('keluarga');
	}

}

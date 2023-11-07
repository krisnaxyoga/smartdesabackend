<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProgramPesertaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('program_peserta', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->decimal('peserta', 16, 0);
			$table->integer('program_id');
			$table->boolean('sasaran')->nullable();
			$table->string('no_id_kartu', 30)->nullable();
			$table->string('kartu_nik')->nullable();
			$table->string('kartu_nama', 100)->nullable();
			$table->string('kartu_tempat_lahir', 100)->nullable();
			$table->date('kartu_tanggal_lahir')->nullable();
			$table->string('kartu_alamat', 200)->nullable();
			$table->string('kartu_peserta', 100)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('program_peserta');
	}

}

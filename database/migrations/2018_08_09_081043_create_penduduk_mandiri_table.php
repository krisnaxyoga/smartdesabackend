<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePendudukMandiriTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('penduduk_mandiri', function(Blueprint $table)
		{
			$table->decimal('nik', 16, 0);
			$table->char('pin', 32);
			$table->dateTime('last_login')->nullable();
			$table->dateTime('tanggal_buat')->nullable();
			$table->integer('id_pend')->primary();
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
		Schema::drop('penduduk_mandiri');
	}

}

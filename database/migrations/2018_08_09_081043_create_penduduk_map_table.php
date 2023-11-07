<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePendudukMapTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('penduduk_map', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('lat', 24)->nullable();
			$table->string('lng', 24)->nullable();
			$table->integer('penduduk_id');
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
		Schema::drop('penduduk_map');
	}

}

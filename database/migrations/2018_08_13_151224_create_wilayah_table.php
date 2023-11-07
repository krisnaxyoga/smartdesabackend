<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWilayahTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('wilayah', function(Blueprint $table)
		{
            $table->increments('id');
            $table->integer('desa_id');
			$table->string('rt', 10)->default('0');
			$table->string('rw', 10)->default('0');
			$table->string('dusun', 50)->default('0');
			$table->integer('id_kepala')->nullable();
			$table->string('lat', 20);
			$table->string('lng', 20);
			$table->integer('zoom');
			$table->text('path');
			$table->string('map_tipe', 20);
			$table->unique(['rt','rw','dusun'], 'rt');
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
		Schema::drop('wilayah');
	}

}

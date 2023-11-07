<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProgramTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('program', function(Blueprint $table)
		{
            $table->integer('id', true);
            $table->integer('desa_id');
			$table->string('nama', 100);
			$table->boolean('sasaran')->nullable();
			$table->string('ndesc', 200)->nullable();
			$table->date('sdate');
			$table->date('edate');
			$table->integer('userid');
			$table->integer('status')->nullable();
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
		Schema::drop('program');
	}

}

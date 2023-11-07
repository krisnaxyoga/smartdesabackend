<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDesaPamongTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('desa_pamong', function(Blueprint $table)
		{
            $table->increments('id');
            $table->integer('desa_id');
			$table->string('pamong_nama', 100)->nullable();
			$table->string('pamong_nip', 20)->nullable();
			$table->string('pamong_nik', 20)->nullable();
			$table->string('jabatan', 50)->nullable();
			$table->boolean('pamong_status')->default(1);
			$table->date('pamong_tgl_terdaftar')->nullable();
			$table->boolean('pamong_ttd')->nullable();
            $table->text('foto')->nullable();
            $table->string('username');
            $table->string('password');
            $table->string('token');
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
		Schema::drop('desa_pamong');
	}

}

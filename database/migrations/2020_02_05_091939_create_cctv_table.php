<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCctvTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cctv', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('desa_id');
            $table->string('nama_cctv');
            $table->string('link')->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->text('keterangan')->nullable();
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
        Schema::dropIfExists('cctv');
    }
}

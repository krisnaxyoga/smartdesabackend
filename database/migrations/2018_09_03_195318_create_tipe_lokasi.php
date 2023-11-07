<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipeLokasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipe_lokasi', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('desa_id');
            $table->string('name');
            $table->text('icon')->nullable();
            $table->tinyInteger('tipe')->nullable();
            $table->tinyInteger('parent')->nullable();
            $table->tinyInteger('enabled')->default('1');
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
        Schema::dropIfExists('tipe_lokasi');
    }
}

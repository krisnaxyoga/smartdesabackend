<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGarisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('garis', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('desa_id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->text('photo')->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->text('coordinates')->nullable();
            $table->integer('tipe_garis_id')->nullable();
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
        Schema::dropIfExists('garis');
    }
}

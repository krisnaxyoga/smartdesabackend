<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePengaduansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengaduans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('desa_id');
            $table->integer('penduduk_id');
            $table->integer('pengaduan_category_id');
            $table->string('no_pengaduan');
            $table->string('title');
            $table->text('content');
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->string('user_target')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('rating')->nullable();
            $table->string('status')->default('PUBLISH');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->string('photo')->nullable();
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
        Schema::dropIfExists('pengaduans');
    }
}

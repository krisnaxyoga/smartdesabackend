<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsulanDusunTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usulan_dusun', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('desa_id');
            $table->string('pengusul_type',50);
            $table->integer('pengusul_id');
            $table->integer('tahun');
            $table->string('keterangan')->nullable();
            $table->string('attachment')->nullable();
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
        Schema::dropIfExists('usulan_dusun');
    }
}

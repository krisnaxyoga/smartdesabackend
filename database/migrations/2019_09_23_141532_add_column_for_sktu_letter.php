<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnForSktuLetter extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pengajuan_surat', function (Blueprint $table) {
            //
            $table->string('nama_usaha')->nullable();
            $table->string('alamat_usaha')->nullable();
            $table->string('jenis_usaha')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pengajuan_surat', function (Blueprint $table) {
            //
            $table->dropColumn(['nama_usaha', 'alamat_usaha', 'jenis_usaha']);
        });
    }
}

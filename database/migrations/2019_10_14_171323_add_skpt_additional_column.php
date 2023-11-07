<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSkptAdditionalColumn extends Migration
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
            $table->string("pindah_desa")->nullable();
            $table->string("pindah_kec")->nullable();
            $table->string("pindah_kab")->nullable();
            $table->string("pindah_prov")->nullable();
            $table->date("tanggal_pindah")->nullable();
            $table->date("tanggal_kk")->nullable();
            $table->string("no_kk")->nullable();
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
            $table->dropColumn([
                "pindah_desa",
                "pindah_kec",
                "pindah_kab",
                "pindah_prov",
                "tanggal_pindah",
                "tanggal_kk",
            ]);
            
        });
    }
}

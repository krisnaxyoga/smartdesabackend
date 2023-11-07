<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SetNullableCredentialsAccountOnTableKepalaDusun extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kepala_dusun', function (Blueprint $table) {
            //
            $table->string('username')->nullable()->change();
            $table->string('pin',50)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kepala_dusun', function (Blueprint $table) {
            //
        });
    }
}

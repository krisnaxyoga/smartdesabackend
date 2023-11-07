<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnForProfileOnTableKepalaDusun extends Migration
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
            $table->string('phone', 15)->nullable();
            $table->string('address')->nullable();
            $table->string('photo')->nullable();
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
            $table->dropColumn(['phone','address','photo']);
        });
    }
}

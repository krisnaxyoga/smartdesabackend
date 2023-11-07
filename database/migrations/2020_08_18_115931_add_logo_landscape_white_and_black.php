<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLogoLandscapeWhiteAndBlack extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
       Schema::table('desa', function (Blueprint $table) {
            $table->text('logo_landscape', 65535);
            $table->text('logo_landscape_black', 65535);

        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('desa', function (Blueprint $table) {
            $table->dropColumn('logo_landscape');
            $table->dropColumn('logo_landscape_black');
            
        });
    }
}

<?php

use Illuminate\Database\Seeder;

class PendudukKawinTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('penduduk_kawin')->delete();
        
        \DB::table('penduduk_kawin')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nama' => 'BELUM KAWIN',
            ),
            1 => 
            array (
                'id' => 2,
                'nama' => 'KAWIN',
            ),
            2 => 
            array (
                'id' => 3,
                'nama' => 'CERAI HIDUP',
            ),
            3 => 
            array (
                'id' => 4,
                'nama' => 'CERAI MATI',
            ),
        ));
        
        
    }
}
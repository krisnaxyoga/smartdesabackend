<?php

use Illuminate\Database\Seeder;

class PendudukStatusTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('penduduk_status')->delete();
        
        \DB::table('penduduk_status')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nama' => 'TETAP',
            ),
            1 => 
            array (
                'id' => 2,
                'nama' => 'TIDAK AKTIF',
            ),
            2 => 
            array (
                'id' => 3,
                'nama' => 'PENDATANG',
            ),
        ));
        
        
    }
}
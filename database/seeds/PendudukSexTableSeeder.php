<?php

use Illuminate\Database\Seeder;

class PendudukSexTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('penduduk_sex')->delete();
        
        \DB::table('penduduk_sex')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nama' => 'LAKI-LAKI',
            ),
            1 => 
            array (
                'id' => 2,
                'nama' => 'PEREMPUAN',
            ),
        ));
        
        
    }
}
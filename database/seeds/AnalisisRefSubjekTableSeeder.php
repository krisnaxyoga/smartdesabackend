<?php

use Illuminate\Database\Seeder;

class AnalisisRefSubjekTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('analisis_ref_subjek')->delete();
        
        \DB::table('analisis_ref_subjek')->insert(array (
            0 => 
            array (
                'id' => 1,
                'subjek' => 'Penduduk',
            ),
            1 => 
            array (
                'id' => 2,
                'subjek' => 'Keluarga / KK',
            ),
        ));
        
        
    }
}
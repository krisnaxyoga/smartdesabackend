<?php

use Illuminate\Database\Seeder;

class KeluargaSejahteraTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('keluarga_sejahtera')->delete();
        
        \DB::table('keluarga_sejahtera')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nama' => 'Keluarga Pra Sejahtera',
            ),
            1 => 
            array (
                'id' => 2,
                'nama' => 'Keluarga Sejahtera I',
            ),
            2 => 
            array (
                'id' => 3,
                'nama' => 'Keluarga Sejahtera II',
            ),
            3 => 
            array (
                'id' => 4,
                'nama' => 'Keluarga Sejahtera III',
            ),
            4 => 
            array (
                'id' => 5,
                'nama' => 'Keluarga Sejahtera III Plus',
            ),
        ));
        
        
    }
}
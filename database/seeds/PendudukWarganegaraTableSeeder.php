<?php

use Illuminate\Database\Seeder;

class PendudukWarganegaraTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('penduduk_warganegara')->delete();
        
        \DB::table('penduduk_warganegara')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nama' => 'WNI',
            ),
            1 => 
            array (
                'id' => 2,
                'nama' => 'WNA',
            ),
            2 => 
            array (
                'id' => 3,
                'nama' => 'DUA KEWARGANEGARAAN',
            ),
        ));
        
        
    }
}
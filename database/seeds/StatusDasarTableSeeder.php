<?php

use Illuminate\Database\Seeder;

class StatusDasarTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('status_dasar')->delete();
        
        \DB::table('status_dasar')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nama' => 'HIDUP',
            ),
            1 => 
            array (
                'id' => 2,
                'nama' => 'MATI',
            ),
            2 => 
            array (
                'id' => 3,
                'nama' => 'PINDAH',
            ),
            3 => 
            array (
                'id' => 4,
                'nama' => 'HILANG',
            ),
        ));
        
        
    }
}
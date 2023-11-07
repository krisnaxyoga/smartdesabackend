<?php

use Illuminate\Database\Seeder;

class RkpDesaTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('rkp_desa')->delete();
        
        \DB::table('rkp_desa')->insert(array (
            0 => 
            array (
                'id' => 4,
                'desa_id' => '2',
                'tahun' => 2020,
                'created_at' => '2020-03-21 22:28:03',
                'updated_at' => '2020-03-21 22:28:03',
            ),
            1 => 
            array (
                'id' => 5,
                'desa_id' => '2',
                'tahun' => 2020,
                'created_at' => '2020-03-22 22:46:27',
                'updated_at' => '2020-03-22 22:46:27',
            ),
        ));
        
        
    }
}
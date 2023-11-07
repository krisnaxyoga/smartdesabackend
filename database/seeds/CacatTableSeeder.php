<?php

use Illuminate\Database\Seeder;

class CacatTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('cacat')->delete();
        
        \DB::table('cacat')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nama' => 'CACAT FISIK',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'nama' => 'CACAT NETRA/BUTA',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'nama' => 'CACAT RUNGU/WICARA',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'nama' => 'CACAT MENTAL/JIWA',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'nama' => 'CACAT FISIK DAN MENTAL',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'nama' => 'CACAT LAINNYA',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'nama' => 'TIDAK CACAT',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}
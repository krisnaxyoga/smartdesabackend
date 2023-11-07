<?php

use Illuminate\Database\Seeder;

class TempatDilahirkanTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tempat_dilahirkan')->delete();
        
        \DB::table('tempat_dilahirkan')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'RS/RB',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'PUSKESMAS',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'POLINDES',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'RUMAH',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'LAINNYA',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}
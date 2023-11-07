<?php

use Illuminate\Database\Seeder;

class PenolongKelahiranTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('penolong_kelahiran')->delete();
        
        \DB::table('penolong_kelahiran')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nama' => 'DOKTER',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'nama' => 'PERAWAT BIDAN',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'nama' => 'DUKUN',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'nama' => 'LAINNYA',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}
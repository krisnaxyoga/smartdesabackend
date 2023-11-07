<?php

use Illuminate\Database\Seeder;

class JenisKelahiranTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('jenis_kelahiran')->delete();
        
        \DB::table('jenis_kelahiran')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nama' => 'TUNGGAL',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'nama' => 'KEMBAR 2',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'nama' => 'KEMBAR 3',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'nama' => 'KEMBAR 4',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}
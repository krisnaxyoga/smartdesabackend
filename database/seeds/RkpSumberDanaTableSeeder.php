<?php

use Illuminate\Database\Seeder;

class RkpSumberDanaTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('rkp_sumber_dana')->delete();
        
        \DB::table('rkp_sumber_dana')->insert(array (
            0 => 
            array (
                'id' => 1,
                'desa_id' => 2,
                'nama' => 'PBH',
                'dana' => 20000000,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'desa_id' => 2,
                'nama' => 'ADD',
                'dana' => 400000000,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}
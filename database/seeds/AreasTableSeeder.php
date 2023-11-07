<?php

use Illuminate\Database\Seeder;

class AreasTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('areas')->delete();
        
        \DB::table('areas')->insert(array (
            0 => 
            array (
                'id' => '49306384-d4d5-4e9c-8ea0-8b07cc50437b',
                'name' => 'Canggu Club',
                'merchant_id' => '7336808c-9181-4d00-b7a8-567d9dcdb26f',
                'created_at' => '2018-07-02 06:56:45',
                'updated_at' => '2018-07-02 06:56:45',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => '83a89fd6-ff39-4020-bd85-a9cd5e719da1',
            'name' => 'Central Of (Nusa Dua, Jimbaran, Kuta, Ubud)',
                'merchant_id' => '7336808c-9181-4d00-b7a8-567d9dcdb26f',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => '91280695-9fd4-45d0-a5a2-9c12925374e9',
                'name' => 'Seminyak',
                'merchant_id' => '7336808c-9181-4d00-b7a8-567d9dcdb26f',
                'created_at' => '2018-07-02 06:56:17',
                'updated_at' => '2018-07-02 06:56:17',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 'a19ffc9c-a301-4345-95d7-2db7fae5a428',
                'name' => 'Kerobokan',
                'merchant_id' => '7336808c-9181-4d00-b7a8-567d9dcdb26f',
                'created_at' => '2018-07-02 06:56:45',
                'updated_at' => '2018-07-02 06:56:45',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 'f09758ef-31de-4a93-a74c-025b3556a043',
                'name' => 'Sanur',
                'merchant_id' => '7336808c-9181-4d00-b7a8-567d9dcdb26f',
                'created_at' => '2018-07-02 06:56:45',
                'updated_at' => '2018-07-02 06:56:45',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}
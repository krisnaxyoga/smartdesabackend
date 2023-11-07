<?php

use Illuminate\Database\Seeder;

class PortsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ports')->delete();
        
        \DB::table('ports')->insert(array (
            0 => 
            array (
                'id' => '095f5da0-0779-4a1d-a784-3bdffdb75b71',
                'port_code' => 'SNR',
                'name' => 'Sanur',
                'area_id' => '24835904-8ffe-493f-8a3a-0e4af70a1c73',
                'active' => 1,
                'created_at' => '2018-07-02 06:57:43',
                'updated_at' => '2018-07-02 06:57:43',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 'feb3e69c-189c-4bb1-b121-e947dc4170be',
                'port_code' => 'NSP',
                'name' => 'Nusa Penida',
                'area_id' => 'aa5c2249-e307-4d28-b3d2-64b3457524ce',
                'active' => 1,
                'created_at' => '2018-07-02 06:57:30',
                'updated_at' => '2018-07-02 06:57:30',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}
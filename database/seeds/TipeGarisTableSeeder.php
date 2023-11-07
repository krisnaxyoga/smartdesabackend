<?php

use Illuminate\Database\Seeder;

class TipeGarisTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('tipe_garis')->delete();

        \DB::table('tipe_garis')->insert(array (
            0 =>
            array (
                'id' => 1,
                'desa_id' => 2,
                'name' => 'Jalan',
                'color' => '546e7a',
                'enabled' => 1,
                'created_at' => '2018-09-22 18:08:18',
                'updated_at' => NULL,
            ),
            1 =>
            array (
                'id' => 2,
                'desa_id' => 2,
                'name' => 'Jembatan',
                'color' => '27CC33',
                'enabled' => 1,
                'created_at' => '2018-09-22 18:08:18',
                'updated_at' => NULL,
            ),
            2 =>
            array (
                'id' => 3,
                'desa_id' => 2,
                'name' => 'Gang',
                'color' => '00897b',
                'enabled' => 1,
                'created_at' => '2018-09-22 18:08:18',
                'updated_at' => NULL,
            ),
        ));


    }
}

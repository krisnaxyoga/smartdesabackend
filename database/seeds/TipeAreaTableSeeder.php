<?php

use Illuminate\Database\Seeder;

class TipeAreaTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('tipe_area')->delete();

        \DB::table('tipe_area')->insert(array (
            0 =>
            array (
                'id' => 1,
                'desa_id' => 2,
                'name' => 'Dusun',
                'color' => 'C0CA33',
                'enabled' => 1,
                'created_at' => '2018-09-22 18:07:39',
                'updated_at' => '2018-09-25 10:42:04',
            ),
            1 =>
            array (
                'id' => 2,
                'desa_id' => 2,
                'name' => 'Potensi Desa',
                'color' => '6d4c41',
                'enabled' => 1,
                'created_at' => '2018-09-22 18:07:39',
                'updated_at' => '2018-09-22 18:07:39',
            ),
        ));


    }
}

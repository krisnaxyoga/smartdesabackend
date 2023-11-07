<?php

use Illuminate\Database\Seeder;

class ProgramTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('program')->delete();

        \DB::table('program')->insert(array (
            0 =>
            array (
                'id' => 1,
                'desa_id' => 2,
                'nama' => 'Raskin',
                'sasaran' => 2,
                'ndesc' => NULL,
                'sdate' => '2018-01-01',
                'edate' => '2018-12-31',
                'userid' => 0,
                'status' => NULL,
            ),
            1 =>
            array (
                'id' => 2,
                'desa_id' => 2,
                'nama' => 'Bedah Rumah',
                'sasaran' => 2,
                'ndesc' => NULL,
                'sdate' => '2018-01-01',
                'edate' => '2018-12-31',
                'userid' => 0,
                'status' => NULL,
            ),
        ));


    }
}

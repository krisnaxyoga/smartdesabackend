<?php

use Illuminate\Database\Seeder;

class PendudukMapTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('penduduk_map')->delete();
        
        \DB::table('penduduk_map')->insert(array (
            0 => 
            array (
                'id' => 10,
                'lat' => '-8.64460899999999',
                'lng' => '115.2097227106201',
                'penduduk_id' => 11,
                'created_at' => '2018-08-18 02:38:00',
                'updated_at' => '2018-09-01 03:19:05',
            ),
            1 => 
            array (
                'id' => 11,
                'lat' => NULL,
                'lng' => NULL,
                'penduduk_id' => 12,
                'created_at' => '2018-08-18 03:15:15',
                'updated_at' => '2018-08-18 03:18:43',
            ),
            2 => 
            array (
                'id' => 12,
                'lat' => '-8.643548303227117',
                'lng' => '115.20564575291746',
                'penduduk_id' => 13,
                'created_at' => '2018-09-02 21:29:34',
                'updated_at' => '2018-09-02 21:29:34',
            ),
            3 => 
            array (
                'id' => 13,
                'lat' => '-8.643548303227117',
                'lng' => '115.20500202275389',
                'penduduk_id' => 14,
                'created_at' => '2018-09-02 21:35:10',
                'updated_at' => '2018-09-02 21:35:10',
            ),
        ));
        
        
    }
}
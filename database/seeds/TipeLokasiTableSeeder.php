<?php

use Illuminate\Database\Seeder;

class TipeLokasiTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('tipe_lokasi')->delete();

        \DB::table('tipe_lokasi')->insert(array (
            0 =>
            array (
                'id' => 1,
                'desa_id' => 2,
                'name' => 'Sarana Pendidikan',
                'icon' => 'school.png',
                'tipe' => NULL,
                'parent' => NULL,
                'enabled' => 1,
                'created_at' => '2018-09-21 21:39:22',
                'updated_at' => '2018-09-21 21:39:22',
            ),
            1 =>
            array (
                'id' => 2,
                'desa_id' => 2,
                'name' => 'Masjid/Musholla',
                'icon' => 'mosquee.png',
                'tipe' => NULL,
                'parent' => NULL,
                'enabled' => 1,
                'created_at' => '2018-09-21 21:40:45',
                'updated_at' => '2018-09-22 17:34:58',
            ),
            2 =>
            array (
                'id' => 3,
                'desa_id' => 2,
                'name' => 'Sarana Kesehatan',
                'icon' => 'hospital-building.png',
                'tipe' => NULL,
                'parent' => NULL,
                'enabled' => 1,
                'created_at' => '2018-09-21 21:41:38',
                'updated_at' => '2018-09-21 21:41:38',
            ),
            3 =>
            array (
                'id' => 4,
                'desa_id' => 2,
                'name' => 'Taman Kota',
                'icon' => 'flowers.png',
                'tipe' => NULL,
                'parent' => NULL,
                'enabled' => 1,
                'created_at' => '2018-09-21 21:46:34',
                'updated_at' => '2018-09-21 21:46:34',
            ),
            4 =>
            array (
                'id' => 5,
                'desa_id' => 2,
                'name' => 'Pura',
                'icon' => 'templehindu.png',
                'tipe' => NULL,
                'parent' => NULL,
                'enabled' => 1,
                'created_at' => '2018-09-22 17:35:15',
                'updated_at' => '2018-09-22 17:35:15',
            ),
            5 =>
            array (
                'id' => 6,
                'desa_id' => 2,
                'name' => 'Gereja',
                'icon' => 'church-2.png',
                'tipe' => NULL,
                'parent' => NULL,
                'enabled' => 1,
                'created_at' => '2018-09-22 17:35:29',
                'updated_at' => '2018-09-22 17:35:29',
            ),
            6 =>
            array (
                'id' => 7,
                'desa_id' => 2,
                'name' => 'Vihara',
                'icon' => 'japanese-temple.png',
                'tipe' => NULL,
                'parent' => NULL,
                'enabled' => 1,
                'created_at' => '2018-09-22 17:36:06',
                'updated_at' => '2018-09-22 17:36:06',
            ),
            7 =>
            array (
                'id' => 8,
                'desa_id' => 2,
                'name' => 'Kantor Pemerintah',
                'icon' => 'conference.png',
                'tipe' => NULL,
                'parent' => NULL,
                'enabled' => 1,
                'created_at' => '2018-09-22 17:47:47',
                'updated_at' => '2018-09-22 17:47:47',
            ),
            8 =>
            array (
                'id' => 9,
                'desa_id' => 2,
                'name' => 'Kantor Polisi',
                'icon' => 'police.png',
                'tipe' => NULL,
                'parent' => NULL,
                'enabled' => 1,
                'created_at' => '2018-09-22 17:49:51',
                'updated_at' => '2018-09-22 17:49:51',
            ),
        ));
    }
}

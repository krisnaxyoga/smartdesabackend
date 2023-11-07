<?php

use Illuminate\Database\Seeder;

class WilayahTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('wilayah')->delete();

        \DB::table('wilayah')->insert(array (
            0 =>
            array (
                'id' => 1,
                'desa_id' => 1,
                'rt' => '0',
                'rw' => '0',
                'dusun' => 'Dusun Wanasari',
                'id_kepala' => NULL,
                'lat' => '',
                'lng' => '',
                'zoom' => 0,
                'path' => '',
                'map_tipe' => '',
                'created_at' => '2018-08-18 01:55:59',
                'updated_at' => '2018-09-02 21:05:29',
            ),
            1 =>
            array (
                'id' => 2,
                'desa_id' => 1,
                'rt' => '0',
                'rw' => '0',
                'dusun' => 'Dusun Wangaya',
                'id_kepala' => NULL,
                'lat' => '',
                'lng' => '',
                'zoom' => 0,
                'path' => '',
                'map_tipe' => '',
                'created_at' => '2018-08-30 01:17:41',
                'updated_at' => '2018-09-02 21:05:21',
            ),
            2 =>
            array (
                'id' => 3,
                'desa_id' => 1,
                'rt' => '0',
                'rw' => '0',
                'dusun' => 'Dusun Lumintang',
                'id_kepala' => NULL,
                'lat' => '',
                'lng' => '',
                'zoom' => 0,
                'path' => '',
                'map_tipe' => '',
                'created_at' => '2018-08-30 01:17:55',
                'updated_at' => '2018-09-02 21:05:13',
            ),
            3 =>
            array (
                'id' => 4,
                'desa_id' => 1,
                'rt' => '0',
                'rw' => '0',
                'dusun' => 'Dusun Wangaya Klod',
                'id_kepala' => NULL,
                'lat' => '',
                'lng' => '',
                'zoom' => 0,
                'path' => '',
                'map_tipe' => '',
                'created_at' => '2018-09-02 21:05:37',
                'updated_at' => '2018-09-02 21:05:37',
            ),
            4 =>
            array (
                'id' => 5,
                'desa_id' => 1,
                'rt' => '0',
                'rw' => '0',
                'dusun' => 'Dusun Lelangon',
                'id_kepala' => NULL,
                'lat' => '',
                'lng' => '',
                'zoom' => 0,
                'path' => '',
                'map_tipe' => '',
                'created_at' => '2018-09-02 21:05:44',
                'updated_at' => '2018-09-02 21:05:44',
            ),
            5 =>
            array (
                'id' => 6,
                'desa_id' => 1,
                'rt' => '0',
                'rw' => '0',
                'dusun' => 'Dusun Mekarsari',
                'id_kepala' => NULL,
                'lat' => '',
                'lng' => '',
                'zoom' => 0,
                'path' => '',
                'map_tipe' => '',
                'created_at' => '2018-09-02 21:05:52',
                'updated_at' => '2018-09-02 21:05:52',
            ),
            6 =>
            array (
                'id' => 7,
                'desa_id' => 1,
                'rt' => '0',
                'rw' => '0',
                'dusun' => 'Dusun Terunasari',
                'id_kepala' => NULL,
                'lat' => '',
                'lng' => '',
                'zoom' => 0,
                'path' => '',
                'map_tipe' => '',
                'created_at' => '2018-09-02 21:05:59',
                'updated_at' => '2018-09-02 21:05:59',
            ),
            7 =>
            array (
                'id' => 8,
                'desa_id' => 2,
                'rt' => '0',
                'rw' => '0',
                'dusun' => 'Dusun Kembang Sari',
                'id_kepala' => NULL,
                'lat' => '',
                'lng' => '',
                'zoom' => 0,
                'path' => '',
                'map_tipe' => '',
                'created_at' => '2018-09-02 21:06:59',
                'updated_at' => '2018-09-02 21:06:59',
            ),
            8 =>
            array (
                'id' => 9,
                'desa_id' => 2,
                'rt' => '0',
                'rw' => '0',
                'dusun' => 'Dusun Ulapan I',
                'id_kepala' => NULL,
                'lat' => '',
                'lng' => '',
                'zoom' => 0,
                'path' => '',
                'map_tipe' => '',
                'created_at' => '2018-09-02 21:09:59',
                'updated_at' => '2018-09-02 21:09:59',
            ),
            9 =>
            array (
                'id' => 10,
                'desa_id' => 2,
                'rt' => '0',
                'rw' => '0',
                'dusun' => 'Dusun Ulapan II',
                'id_kepala' => NULL,
                'lat' => '',
                'lng' => '',
                'zoom' => 0,
                'path' => '',
                'map_tipe' => '',
                'created_at' => '2018-09-02 21:01:59',
                'updated_at' => '2018-09-02 21:01:59',
            ),
            10 =>
            array (
                'id' => 11,
                'desa_id' => 2,
                'rt' => '0',
                'rw' => '0',
                'dusun' => 'Dusun Delod Pasar',
                'id_kepala' => NULL,
                'lat' => '',
                'lng' => '',
                'zoom' => 0,
                'path' => '',
                'map_tipe' => '',
                'created_at' => '2018-09-02 21:05:59',
                'updated_at' => '2018-09-02 21:05:59',
            ),
            11 =>
            array (
                'id' => 12,
                'desa_id' => 2,
                'rt' => '0',
                'rw' => '0',
                'dusun' => 'Dusun Tengah',
                'id_kepala' => NULL,
                'lat' => '',
                'lng' => '',
                'zoom' => 0,
                'path' => '',
                'map_tipe' => '',
                'created_at' => '2018-09-02 21:10:59',
                'updated_at' => '2018-09-02 21:10:59',
            ),
            12 =>
            array (
                'id' => 13,
                'desa_id' => 2,
                'rt' => '0',
                'rw' => '0',
                'dusun' => 'Dusun Benehkawan',
                'id_kepala' => NULL,
                'lat' => '',
                'lng' => '',
                'zoom' => 0,
                'path' => '',
                'map_tipe' => '',
                'created_at' => '2018-09-02 21:12:59',
                'updated_at' => '2018-09-02 21:12:59',
            ),
            13 =>
            array (
                'id' => 14,
                'desa_id' => 2,
                'rt' => '0',
                'rw' => '0',
                'dusun' => 'Dusun Pikah',
                'id_kepala' => NULL,
                'lat' => '',
                'lng' => '',
                'zoom' => 0,
                'path' => '',
                'map_tipe' => '',
                'created_at' => '2018-09-02 21:14:59',
                'updated_at' => '2018-09-02 21:14:59',
            ),
            14 =>
            array (
                'id' => 15,
                'desa_id' => 2,
                'rt' => '0',
                'rw' => '0',
                'dusun' => 'Dusun Pacung',
                'id_kepala' => NULL,
                'lat' => '',
                'lng' => '',
                'zoom' => 0,
                'path' => '',
                'map_tipe' => '',
                'created_at' => '2018-09-02 21:16:59',
                'updated_at' => '2018-09-02 21:16:59',
            ),
        ));


    }
}

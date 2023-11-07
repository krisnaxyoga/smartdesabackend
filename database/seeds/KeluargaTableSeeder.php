<?php

use Illuminate\Database\Seeder;

class KeluargaTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('keluarga')->delete();

        \DB::table('keluarga')->insert(array (
            0 =>
            array (
                'id' => 38,
                'desa_id'=> 1,
                'no_kk' => '51099823319923',
                'nik_kepala' => '13',
                'tgl_daftar' => '2018-09-02 22:05:50',
                'kelas_sosial' => NULL,
                'tgl_cetak_kk' => NULL,
                'alamat' => NULL,
                'id_cluster' => 1,
                'created_at' => '2018-09-02 22:05:50',
                'updated_at' => '2018-09-02 22:06:07',
            ),
            array (
                'id' => 39,
                'desa_id'=> 2,
                'no_kk' => '51099823319924',
                'nik_kepala' => '510205290819930004',
                'tgl_daftar' => '2018-09-02 22:05:50',
                'kelas_sosial' => NULL,
                'tgl_cetak_kk' => NULL,
                'alamat' => NULL,
                'id_cluster' => 1,
                'created_at' => '2018-09-02 22:05:50',
                'updated_at' => '2018-09-02 22:06:07',
            ),
        ));


    }
}

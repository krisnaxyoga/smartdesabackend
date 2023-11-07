<?php

use Illuminate\Database\Seeder;

class BidangEplanningTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('bidang_eplanning')->delete();
        
        \DB::table('bidang_eplanning')->insert(array (
            0 => 
            array (
                'id' => 1,
                'parent_id' => NULL,
                'desa_id' => '2',
                'kode_bidang' => '01',
                'nama_bidang' => 'Penyelenggaraan Pemerintahan Desa',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'parent_id' => NULL,
                'desa_id' => '2',
                'kode_bidang' => '02',
                'nama_bidang' => 'Pembangunan Desa',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'parent_id' => NULL,
                'desa_id' => '2',
                'kode_bidang' => '03',
                'nama_bidang' => 'Pembinaan Kemasyarakatan ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'parent_id' => NULL,
                'desa_id' => '2',
                'kode_bidang' => '04',
                'nama_bidang' => 'Pemberdayaan Masyarakat',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'parent_id' => NULL,
                'desa_id' => '1',
                'kode_bidang' => NULL,
                'nama_bidang' => 'Penyelenggaraan Pemerintahan Desa',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'parent_id' => NULL,
                'desa_id' => '1',
                'kode_bidang' => NULL,
                'nama_bidang' => 'Pembangunan Desa',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'parent_id' => NULL,
                'desa_id' => '1',
                'kode_bidang' => NULL,
                'nama_bidang' => 'Pembinaan Kemasyarakatan ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'parent_id' => NULL,
                'desa_id' => '1',
                'kode_bidang' => NULL,
                'nama_bidang' => 'Pemberdayaan Masyarakat',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'parent_id' => '2',
                'desa_id' => '2',
                'kode_bidang' => NULL,
                'nama_bidang' => 'PROGRAM OPERASIONAL PEMERINTAHAN DESA',
                'created_at' => '2020-03-17 14:48:25',
                'updated_at' => '2020-03-18 17:11:58',
            ),
            9 => 
            array (
                'id' => 10,
                'parent_id' => '1',
                'desa_id' => '2',
                'kode_bidang' => NULL,
                'nama_bidang' => 'PROGRAM PENINGKATAN KAPASITAS SUMBERDAYA DAN DISIPLIN APARATUR PEMERINTAH DESA',
                'created_at' => '2020-03-17 14:49:47',
                'updated_at' => '2020-03-17 14:49:47',
            ),
        ));
        
        
    }
}
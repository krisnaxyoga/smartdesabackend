<?php

use Illuminate\Database\Seeder;

class KelompokMasterTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('kelompok_master')->delete();
        
        \DB::table('kelompok_master')->insert(array (
            0 => 
            array (
                'id' => 3,
                'kelompok' => 'Kelompok Sosial Kemasyarakat',
                'deskripsi' => 'Kelompok Sosial Kemasyarakat',
                'created_at' => '2018-12-11 19:19:54',
                'updated_at' => '2018-12-11 19:19:54',
            ),
            1 => 
            array (
                'id' => 4,
                'kelompok' => 'Kelompok Asosiasi',
                'deskripsi' => 'Kelompok Asosiasi',
                'created_at' => '2018-12-11 19:20:02',
                'updated_at' => '2018-12-11 19:20:02',
            ),
            2 => 
            array (
                'id' => 5,
                'kelompok' => 'Kelompok UMKM',
                'deskripsi' => 'Kelompok UMKM',
                'created_at' => '2018-12-11 19:20:10',
                'updated_at' => '2018-12-11 19:20:10',
            ),
        ));
        
        
    }
}
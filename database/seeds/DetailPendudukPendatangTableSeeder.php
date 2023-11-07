<?php

use Illuminate\Database\Seeder;

class DetailPendudukPendatangTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('detail_penduduk_pendatang')->delete();
        
        \DB::table('detail_penduduk_pendatang')->insert(array (
            0 => 
            array (
                'id' => 1,
                'duktang_id' => 4,
                'nik' => '510205290819930004',
                'nama' => 'Wayan Bayu',
                'sex_id' => 1,
                'tanggallahir' => '1993-08-29',
                'status_kawin_id' => 1,
                'pendidikan_id' => 8,
                'status_keluarga_id' => 10,
                'keterangan' => 'errwerwe',
                'created_at' => '2020-02-03 02:36:06',
                'updated_at' => '2020-02-03 02:36:06',
            ),
        ));
        
        
    }
}
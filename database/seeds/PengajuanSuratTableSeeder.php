<?php

use Illuminate\Database\Seeder;

class PengajuanSuratTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('pengajuan_surat')->delete();
        
        \DB::table('pengajuan_surat')->insert(array (
            0 => 
            array (
                'id' => 1,
                'dusun_id' => 1,
                'keperluan' => 'Pengajuan Beasiswa ',
                'penduduk_id' => 1,
                'jenis_surat_id' => 1,
                'status' => 'REJECTED',
                'created_at' => NULL,
                'updated_at' => '2019-04-18 17:06:08',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}
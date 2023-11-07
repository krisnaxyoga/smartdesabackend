<?php

use Illuminate\Database\Seeder;

class PendudukPendatangTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('penduduk_pendatang')->delete();

        \DB::table('penduduk_pendatang')->insert(array (
            0 =>
            array (
                'id' => 4,
                'desa_id' => 2,
                'nik' => '5108040612980012',
                'no_kk' => '5108040612980014',
                'nama' => 'Ketut Canteg',
                'sex_id' => 1,
                'tempat_lahir' => 'TIGAWASA',
                'tanggal_lahir' => '1998-02-10',
                'golongan_darah_id' => 2,
                'agama_id' => 4,
                'status_kawin_id' => 2,
                'status_keluarga_id' => 2,
                'pendidikan_id' => 5,
                'pekerjaan_id' => 10,
                'warga_negara_id' => 1,
                'no_hp' => '085123342131',
                'email' => 'example@mail.com',
                'status' => NULL,
                'alasan_domisili' => 'Kerja',
                'alamat_asal' => 'Jl 123',
                'desa_asal_id' => 5108040009,
                'dusun_tinggal_id' => 9,
                'jenis_tempat_tinggal_id' => 1,
                'alamat_tinggal' => 'Jl 1234234',
                'photo' => NULL,
                'photo_ktp' => NULL,
                'status_verifikasi' => 'ya',
                'tanggal_melapor' => '2020-02-02',
                'surat' => 'KTP',
                'no_surat_desa' => '001/BLKU/XIV/2020',
                'masa_berlaku' => NULL,
                'staff_id' => 1,
                'created_at' => '2020-02-03 02:36:06',
                'updated_at' => '2020-02-03 02:36:06',
            ),
        ));


    }
}

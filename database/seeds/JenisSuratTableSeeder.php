<?php

use Illuminate\Database\Seeder;

class JenisSuratTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('jenis_surat')->delete();

        \DB::table('jenis_surat')->insert(array(
            0 =>
            array(
                'id' => 1,
                'kode_surat' => 'SKP',
                'judul' => 'SURAT KETERANGAN PENGANTAR',
                'tipe' => '[1,2]',
                'is_mobile' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 =>
            array(
                'id' => 2,
                'kode_surat' => 'SBP',
                'judul' => 'SURAT BIODATA PENDUDUK',
                'tipe' => '[1]',
                'is_mobile' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 =>
            array(
                'id' => 3,
                'kode_surat' => 'SPSKCK',
                'judul' => 'SURAT PENGANTAR SURAT KETERANGAN CATATAN KEPOLISIAN',
                'tipe' => '[1]',
                'is_mobile' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 =>
            array(
                'id' => 4,
                'kode_surat' => 'SKKDP',
                'judul' => 'SURAT KETERANGAN KTP DALAM PROSES',
                'tipe' => '[1]',
                'is_mobile' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 =>
            array(
                'id' => 5,
                'kode_surat' => 'SKTM',
                'judul' => 'SURAT KETERANGAN TIDAK MAMPU',
                'tipe' => '[1]',
                'is_mobile' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 =>
            array(
                'id' => 6,
                'kode_surat' => 'SPIK',
                'judul' => 'SURAT PENGANTAR IZIN KERAMAIAN',
                'tipe' => '[1,3,4]',
                'is_mobile' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 =>
            array(
                'id' => 7,
                'kode_surat' => 'SKKM',
                'judul' => 'SURAT KETERANGAN KAWIN/MENIKAH',
                'tipe' => '[1,6,7,8]',
                'is_mobile' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            7 =>
            array(
                'id' => 8,
                'kode_surat' => 'SKU',
                'judul' => 'SURAT KETERANGAN USAHA',
                'tipe' => '[1,5]',
                'is_mobile' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            8 =>
            array(
                'id' => 9,
                'kode_surat' => 'SKTU',
                'judul' => 'SURAT KETERANGAN USAHA',
                'tipe' => '[1,5]',
                'is_mobile' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            9 =>
            array(
                'id' => 10,
                'kode_surat' => 'SKPK',
                'judul' => 'SURAT KETERANGAN PENGANTAR KTP',
                'tipe' => '[1]',
                'is_mobile' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            10 =>
            array(
                'id' => 11,
                'kode_surat' => 'SKBB',
                'judul' => 'SURAT KETERANGAN BELUM BEKERJA',
                'tipe' => '[1]',
                'is_mobile' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            11 =>
            array(
                'id' => 12,
                'kode_surat' => 'SKBPKM',
                'judul' => 'SURAT KETERANGAN BELUM PERNAH KAWIN/MENIKAH',
                'tipe' => '[1]',
                'is_mobile' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            12 =>
            array(
                'id' => 13,
                'kode_surat' => 'SPS',
                'judul' => 'SURAT PERNYATAAN',
                'tipe' => '[1,7]',
                'is_mobile' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            13 =>
            array(
                'id' => 14,
                'kode_surat' => 'SKKB',
                'judul' => 'SURAT KETERANGAN BERKELAKUAN BAIK',
                'tipe' => '[1]',
                'is_mobile' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            14 =>
            array(
                'id' => 15,
                'kode_surat' => 'SKD',
                'judul' => 'SURAT KETERANGAN',
                'tipe' => '[1,10]',
                'is_mobile' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            15 =>
            array(
                'id' => 16,
                'kode_surat' => 'SKPT',
                'judul' => 'SURAT KETERANGAN PINDAH',
                'tipe' => '[9]',
                'is_mobile' => 0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
    }
}

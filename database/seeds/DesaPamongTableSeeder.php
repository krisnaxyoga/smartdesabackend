<?php

use Illuminate\Database\Seeder;

class DesaPamongTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('desa_pamong')->delete();

        \DB::table('desa_pamong')->insert(array (
            0 =>
            array (
                'desa_id' => 2,
                'pamong_nama' => 'Nyoman Gde Risnawan, SE.',
                'pamong_nip' => '',
                'pamong_nik' => '',
                'jabatan' => 'Kepala Desa',
                'pamong_status' => '1',
                'pamong_tgl_terdaftar' => '2014-04-20',
                'pamong_ttd' => 1,
                'foto' => 'CjR9Xl_kades.jpg',
                'username' => 'user01',
                'password' => '$2y$10$UdThDpw.SYbZakVinN.5oOzFbeVezcc53UTbmzFPXVPdzMe.uQtYG'
            ),
            1 =>
            array (
                'desa_id' => 2,
                'pamong_nama' => 'Nama Sekdes',
                'pamong_nip' => '197905062010011007',
                'pamong_nik' => '5201140506790001',
                'jabatan' => 'Sekretaris Desa',
                'pamong_status' => '1',
                'pamong_tgl_terdaftar' => '2016-08-23',
                'pamong_ttd' => NULL,
                'foto' => '',
                'username' => 'user02',
                'password' => '$2y$10$UdThDpw.SYbZakVinN.5oOzFbeVezcc53UTbmzFPXVPdzMe.uQtYG'
            ),
            2 =>
            array (
                'desa_id' => 2,
                'pamong_nama' => 'Kaur Pemerintahan ',
                'pamong_nip' => '-',
                'pamong_nik' => '',
                'jabatan' => 'Kaur Pemerintahan ',
                'pamong_status' => '1',
                'pamong_tgl_terdaftar' => '2016-08-23',
                'pamong_ttd' => NULL,
                'foto' => '',
                'username' => 'user03',
                'password' => '$2y$10$UdThDpw.SYbZakVinN.5oOzFbeVezcc53UTbmzFPXVPdzMe.uQtYG'
            ),
            3 =>
            array (
                'desa_id' => 2,
                'pamong_nama' => 'Kaur Umum ',
                'pamong_nip' => '-',
                'pamong_nik' => '5201140101710003',
                'jabatan' => 'Kaur Umum ',
                'pamong_status' => '1',
                'pamong_tgl_terdaftar' => '2016-08-23',
                'pamong_ttd' => NULL,
                'foto' => '',
                'username' => 'user04',
                'password' => '$2y$10$UdThDpw.SYbZakVinN.5oOzFbeVezcc53UTbmzFPXVPdzMe.uQtYG'
            ),
            4 =>
            array (
                'desa_id' => 2,
                'pamong_nama' => 'Kaur Keuangan',
                'pamong_nip' => '-',
                'pamong_nik' => '5201145203810001',
                'jabatan' => 'Kaur Keuangan',
                'pamong_status' => '1',
                'pamong_tgl_terdaftar' => '2016-08-23',
                'pamong_ttd' => NULL,
                'foto' => 'cNzva0_bendahara.jpg',
                'username' => 'user05',
                'password' =>'$2y$10$UdThDpw.SYbZakVinN.5oOzFbeVezcc53UTbmzFPXVPdzMe.uQtYG'
            ),
            5 =>
            array (
                'desa_id' => 2,
                'pamong_nama' => 'Kaur Pembangunan',
                'pamong_nip' => '-',
                'pamong_nik' => '5201140506730002',
                'jabatan' => 'Kaur Pembangunan ',
                'pamong_status' => '1',
                'pamong_tgl_terdaftar' => '2016-08-23',
                'pamong_ttd' => NULL,
                'foto' => '',
                'username' => 'user06',
                'password' => '$2y$10$UdThDpw.SYbZakVinN.5oOzFbeVezcc53UTbmzFPXVPdzMe.uQtYG'
            ),
            6 =>
            array (
                'desa_id' => 2,
                'pamong_nama' => 'Kaur Keamanan dan Ketertiban',
                'pamong_nip' => '',
                'pamong_nik' => '',
                'jabatan' => 'Kaur Keamanan dan Ketertiban',
                'pamong_status' => '1',
                'pamong_tgl_terdaftar' => '2016-08-23',
                'pamong_ttd' => NULL,
                'foto' => '',
                'username' => 'user07',
                'password' => '$2y$10$UdThDpw.SYbZakVinN.5oOzFbeVezcc53UTbmzFPXVPdzMe.uQtYG'
            ),
        ));


    }
}

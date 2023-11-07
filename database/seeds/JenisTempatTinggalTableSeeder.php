<?php

use Illuminate\Database\Seeder;

class JenisTempatTinggalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('jenis_tempat_tinggal')->delete();

        \DB::table('jenis_tempat_tinggal')->insert(array (
            0 =>
            array (
                'id' => 1,
                'nama' => 'KONTRAK',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 =>
            array (
                'id' => 2,
                'nama' => 'KOST',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 =>
            array (
                'id' => 3,
                'nama' => 'RUMAH SENDIRI',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 =>
            array (
                'id' => 4,
                'nama' => 'RUMAH SAUDARA',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
    }
}

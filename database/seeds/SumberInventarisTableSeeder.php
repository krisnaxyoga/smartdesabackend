<?php

use Illuminate\Database\Seeder;

class SumberInventarisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('sumber_inventaris')->delete();

        \DB::table('sumber_inventaris')->insert(array (
            0 =>
            array (
                'id' => 1,
                'nama_sumber_inventaris' => 'APBDES',
            ),
            1 =>
            array (
                'id' => 2,
                'nama_sumber_inventaris' => 'APBD Kabupaten',
            ),
            2 =>
            array (
                'id' => 3,
                'nama_sumber_inventaris' => 'APBD Provinsi',
            ),
            3 =>
            array (
                'id' => 4,
                'nama_sumber_inventaris' => 'APBN',
            ),
            4 =>
            array (
                'id' => 5,
                'nama_sumber_inventaris' => 'Hibah',
            ),
        ));
    }
}

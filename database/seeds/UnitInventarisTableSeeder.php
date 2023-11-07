<?php

use Illuminate\Database\Seeder;

class UnitInventarisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        \DB::table('unit')->delete();

        \DB::table('unit')->insert(array (
            0 =>
            array (
                'id' => 1,
                'nama_unit' => 'Buah',
            ),
            1 =>
            array (
                'id' => 2,
                'nama_unit' => 'Set',
            ),
            2 =>
            array (
                'id' => 3,
                'nama_unit' => 'Unit',
            )
        ));
    }
}

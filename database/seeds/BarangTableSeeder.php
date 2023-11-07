<?php

use Illuminate\Database\Seeder;

class BarangTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('barang')->delete();
        
        \DB::table('barang')->insert(array (
            0 => 
            array (
                'id' => 1,
                'desa_id' => 2,
                'name' => 'Kursi Kantor',
                'kode_barang' => '12345',
                'harga' => 500000,
                'kategori_barang_id' => 1,
                'created_at' => '2020-04-12 19:20:00',
                'updated_at' => '2020-04-12 19:20:00',
            ),
        ));
        
        
    }
}
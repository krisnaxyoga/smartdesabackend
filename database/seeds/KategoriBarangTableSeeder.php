<?php

use Illuminate\Database\Seeder;

class KategoriBarangTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('kategori_barang')->delete();
        
        \DB::table('kategori_barang')->insert(array (
            0 => 
            array (
                'id' => 1,
                'desa_id' => 2,
                'name' => 'Properti',
                'created_at' => '2020-04-12 19:18:32',
                'updated_at' => '2020-04-12 19:18:32',
            ),
            1 => 
            array (
                'id' => 2,
                'desa_id' => 2,
                'name' => 'Alat Tulis',
                'created_at' => '2020-04-12 19:19:14',
                'updated_at' => '2020-04-12 19:19:14',
            ),
        ));
        
        
    }
}
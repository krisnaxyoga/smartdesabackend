<?php

use Illuminate\Database\Seeder;

class KategoriArtikelTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('kategori_artikel')->delete();
        
        \DB::table('kategori_artikel')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nama' => 'Olahraga',
                'status' => '1',
                'created_at' => '2018-11-09 12:05:51',
                'updated_at' => '2018-11-09 12:05:51',
            ),
            1 => 
            array (
                'id' => 2,
                'nama' => 'Berita',
                'status' => '1',
                'created_at' => '2018-12-29 10:05:46',
                'updated_at' => '2018-12-29 10:05:46',
            ),
        ));
        
        
    }
}
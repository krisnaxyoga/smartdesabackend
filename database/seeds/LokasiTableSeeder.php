<?php

use Illuminate\Database\Seeder;

class LokasiTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('lokasi')->delete();
        
        \DB::table('lokasi')->insert(array (
            0 => 
            array (
                'id' => 1,
                'desa_id' => 2,
                'name' => 'SD 1 Taman',
                'description' => 'SD 1 Taman',
                'lat' => '-8.488582760627983',
                'lng' => '115.22012176076198',
                'photo' => 'https://s3-ap-southeast-1.amazonaws.com/smartdesa/penduduk/3tPYsekemG3mAzKRhnPqIkqATVeUXJlzzwiFUy15.png',
                'tipe_lokasi_id' => 1,
                'dusun_id' => NULL,
                'cluster_id' => NULL,
                'enabled' => 1,
                'created_at' => '2020-07-13 11:34:51',
                'updated_at' => '2020-07-13 11:34:53',
            ),
            1 => 
            array (
                'id' => 2,
                'desa_id' => 2,
                'name' => 'Pura Puseh Sembung Sobangan',
                'description' => 'Pura Puseh Sembung SObangan',
                'lat' => '-8.472925678227393',
                'lng' => '115.19380944111742',
                'photo' => 'https://s3-ap-southeast-1.amazonaws.com/smartdesa/penduduk/YhR8uAB0bU0g6YExzVqAcud6OeUsuxyMk7hPrq9q.jpeg',
                'tipe_lokasi_id' => 5,
                'dusun_id' => NULL,
                'cluster_id' => NULL,
                'enabled' => 1,
                'created_at' => '2020-07-13 11:36:30',
                'updated_at' => '2020-07-13 11:36:31',
            ),
            2 => 
            array (
                'id' => 3,
                'desa_id' => 2,
                'name' => 'Prebekel Desa Kuwum',
                'description' => 'Kantor Prebekel Desa Kuwum',
                'lat' => '-8.458082575218638',
                'lng' => '115.18034314468535',
                'photo' => 'https://s3-ap-southeast-1.amazonaws.com/smartdesa/penduduk/ajziBnHDf8uMhkHKir5iWpMn2IyOQ3RDRtnoREdE.jpeg',
                'tipe_lokasi_id' => 9,
                'dusun_id' => NULL,
                'cluster_id' => NULL,
                'enabled' => 1,
                'created_at' => '2020-07-13 11:38:31',
                'updated_at' => '2020-07-13 11:38:32',
            ),
        ));
        
        
    }
}
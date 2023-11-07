<?php

use Illuminate\Database\Seeder;

class PengaduanCategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('pengaduan_categories')->delete();
        
        \DB::table('pengaduan_categories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'desa_id' => 2,
                'name' => 'Whistle Blowing',
                'photo' => 'https://s3-ap-southeast-1.amazonaws.com/smartdesa/pengaduan_category/8FLgdq9yNA4yK32MgAKb4sQvpFkWiZI2EjsUdTdM.png',
                'created_at' => '2020-01-29 03:56:18',
                'updated_at' => '2020-01-29 03:56:18',
            ),
            1 => 
            array (
                'id' => 2,
                'desa_id' => 2,
                'name' => 'Layanan Publik',
                'photo' => 'https://s3-ap-southeast-1.amazonaws.com/smartdesa/pengaduan_category/3oCWgdY9a4HaOeYgtnRBz5zsMZGl1y1gKrrO3p5X.png',
                'created_at' => '2020-01-29 03:57:20',
                'updated_at' => '2020-01-29 03:57:20',
            ),
            2 => 
            array (
                'id' => 3,
                'desa_id' => 2,
                'name' => 'Lingkungan',
                'photo' => 'https://s3-ap-southeast-1.amazonaws.com/smartdesa/pengaduan_category/Er1Oeq0NXWrzAumLHAij9k7dOZRwyiyoHSoDlRIs.png',
                'created_at' => '2020-01-29 03:57:44',
                'updated_at' => '2020-01-29 03:57:44',
            ),
            3 => 
            array (
                'id' => 4,
                'desa_id' => 2,
                'name' => 'Infrastruktur',
                'photo' => 'https://s3-ap-southeast-1.amazonaws.com/smartdesa/pengaduan_category/gvYilJ42kuWAy3T218S64Qn2NysmKE0g9HeWA7Zz.png',
                'created_at' => '2020-01-29 03:58:07',
                'updated_at' => '2020-01-29 03:58:07',
            ),
            4 => 
            array (
                'id' => 5,
                'desa_id' => 2,
                'name' => 'Lalu Lintas',
                'photo' => 'https://s3-ap-southeast-1.amazonaws.com/smartdesa/pengaduan_category/BRFCDMP0BdxDojUJkkmfT7dYrvfD2UBUsX6x7Fij.png',
                'created_at' => '2020-01-29 03:58:28',
                'updated_at' => '2020-01-29 03:58:28',
            ),
            5 => 
            array (
                'id' => 6,
                'desa_id' => 2,
                'name' => 'Sosial & Tenaga Kerja',
                'photo' => 'https://s3-ap-southeast-1.amazonaws.com/smartdesa/pengaduan_category/7k2JGbElHmcMH46pDhBrmBQ0qhB9JPrrAkInFlYr.png',
                'created_at' => '2020-01-29 03:58:53',
                'updated_at' => '2020-01-29 03:58:53',
            ),
            6 => 
            array (
                'id' => 7,
                'desa_id' => 2,
                'name' => 'Lain-Lain',
                'photo' => 'https://s3-ap-southeast-1.amazonaws.com/smartdesa/pengaduan_category/Sy7QsSOZ5txiA4OrLmkhXEcughktdevOpo4U9aYs.png',
                'created_at' => '2020-01-29 03:59:24',
                'updated_at' => '2020-01-29 03:59:24',
            ),
        ));
        
        
    }
}
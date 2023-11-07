<?php

use Illuminate\Database\Seeder;

class KtpStatusTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ktp_status')->delete();
        
        \DB::table('ktp_status')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nama' => 'BELUM REKAM',
                'ktp_el' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'nama' => 'SUDAH REKAM',
                'ktp_el' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'nama' => 'CARD PRINTED',
                'ktp_el' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'nama' => 'PRINT READY RECORD',
                'ktp_el' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'nama' => 'CARD SHIPPED',
                'ktp_el' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'nama' => 'SENT FOR CARD PRINTING',
                'ktp_el' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'nama' => 'CARD ISSUED',
                'ktp_el' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}
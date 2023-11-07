<?php

use Illuminate\Database\Seeder;

class GarisTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('garis')->delete();
        
        \DB::table('garis')->insert(array (
            0 => 
            array (
                'id' => 1,
                'desa_id' => 2,
                'name' => 'Jl Raya Sangeh',
                'description' => 'Jl Sangeh',
                'photo' => NULL,
                'lat' => NULL,
                'lng' => NULL,
                'coordinates' => '[{"lat":-8.463811495153054,"lng":115.21259846889862},{"lat":-8.475017591928744,"lng":115.20830693447479},{"lat":-8.47858309971048,"lng":115.20779195034393},{"lat":-8.482488141711125,"lng":115.20968022549042},{"lat":-8.504729145273211,"lng":115.21036687099823},{"lat":-8.524931686112105,"lng":115.20933690273651}]',
                'tipe_garis_id' => 1,
                'enabled' => 1,
                'created_at' => '2020-07-13 11:39:25',
                'updated_at' => '2020-07-13 11:39:25',
            ),
        ));
        
        
    }
}
<?php

use Illuminate\Database\Seeder;

class AreaTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('area')->delete();
        
        \DB::table('area')->insert(array (
            0 => 
            array (
                'id' => 3,
                'desa_id' => 2,
                'name' => 'Desa Wisata Sangeh',
                'description' => 'Desa Wisata Sangeh',
                'photo' => 'https://s3-ap-southeast-1.amazonaws.com/smartdesa/penduduk/tHhTPdGgcDZbORubDz9xgUPmvJ9Wk2rJTFoLiQ0V.jpeg',
                'lat' => NULL,
                'lng' => NULL,
                'coordinates' => '[{"lat":-8.48136858272433,"lng":115.20544825777702},{"lat":-8.4812730791749,"lng":115.20666061625175},{"lat":-8.481432251744105,"lng":115.20750819430046},{"lat":-8.481591424247384,"lng":115.2083450435131},{"lat":-8.48136858272433,"lng":115.20896731600456},{"lat":-8.481156352582232,"lng":115.20913897738151},{"lat":-8.479904192357843,"lng":115.20880638346367},{"lat":-8.479320556960902,"lng":115.20819483980827},{"lat":-8.478652028053517,"lng":115.20668207392387},{"lat":-8.47863080489456,"lng":115.2058774112194},{"lat":-8.47882181328301,"lng":115.20510493502312},{"lat":-8.478853648005193,"lng":115.20464359507255},{"lat":-8.478906705869642,"lng":115.20424662813835},{"lat":-8.481602035745254,"lng":115.2045255778759}]',
                'tipe_area_id' => 2,
                'dusun_id' => NULL,
                'enabled' => 1,
                'created_at' => '2020-07-13 11:40:51',
                'updated_at' => '2020-07-13 11:40:52',
            ),
        ));
        
        
    }
}
<?php

use Illuminate\Database\Seeder;

class DesaTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('desa')->delete();
        
        \DB::table('desa')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nama_desa' => 'Dauh Puri Kaja',
                'kode_desa' => 'DPKJ',
                'nama_kepala_desa' => '-',
                'nip_kepala_desa' => '-',
                'kode_pos' => '80111',
                'kode_village' => '',
                'nama_kecamatan' => 'Denpasar Utara',
                'kode_kecamatan' => '-',
                'nama_kepala_camat' => '-',
                'nip_kepala_camat' => '-',
                'nama_kabupaten' => 'Kota Denpasar',
                'kode_kabupaten' => '-',
                'nama_propinsi' => '-',
                'kode_propinsi' => '-',
                'logo' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/Lambang_Kota_Denpasar_%281%29.png/505px-Lambang_Kota_Denpasar_%281%29.png',
                'logo_landscape_white' => 'https://badungkab.go.id/assets/desa/desasangeh/slider/_707133.jpg',
                'logo_landscape_black' => 'https://badungkab.go.id/assets/desa/desasangeh/slider/_707133.jpg',
                'lat' => '-',
                'lng' => '-',
                'zoom' => 1,
                'map_tipe' => '-',
                'path' => '-',
                'alamat_kantor' => 'Jl. Gatot Subroto VI J',
                'g_analytic' => '-',
                'email_desa' => 'desadauhpurikaja@gmail.com',
                'telepon' => '(0361) 418973',
                'website' => 'http://dauhpurikaja.denpasarkota.go.id',
                'akronim' => 'DPKJ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'facebook' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'nama_desa' => 'Sangeh',
                'kode_desa' => 'SANGEH',
                'nama_kepala_desa' => '-',
                'nip_kepala_desa' => '-',
                'kode_pos' => '-',
                'kode_village' => '02',
                'nama_kecamatan' => 'Abiansemal',
                'kode_kecamatan' => '01',
                'nama_kepala_camat' => '-',
                'nip_kepala_camat' => '-',
                'nama_kabupaten' => 'Kabupaten Badung',
                'kode_kabupaten' => '01',
                'nama_propinsi' => 'Bali',
                'kode_propinsi' => '09',
                'logo' => 'https://upload.wikimedia.org/wikipedia/commons/d/d2/Lambang_Kabupaten_Badung.png',
                'logo_landscape_white' => 'https://badungkab.go.id/assets/desa/desasangeh/slider/_707133.jpg',
                'logo_landscape_black' => 'https://badungkab.go.id/assets/desa/desasangeh/slider/_707133.jpg',
                'lat' => '-8.509560',
                'lng' => '115.210202',
                'zoom' => 1,
                'map_tipe' => '-',
                'path' => '-',
                'alamat_kantor' => 'Jl. Majapahit',
                'g_analytic' => '-',
                'email_desa' => 'sangeh@gmail.com',
                'telepon' => '(0361) 8728922',
                'website' => 'http://pbl-blahkiuh.badungkab.go.id/',
                'akronim' => 'BLKU',
                'created_at' => NULL,
                'updated_at' => NULL,
                'facebook' => 'https://facebook.com',
            ),
        ));
        
        
    }
}
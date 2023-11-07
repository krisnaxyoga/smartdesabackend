<?php

use Illuminate\Database\Seeder;

class ArtikelTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('artikel')->delete();
        
        \DB::table('artikel')->insert(array (
            0 => 
            array (
                'id' => 3,
                'user_id' => 1,
                'judul' => 'Penyerahan Serifikat PTSL Tahun 2017',
                'konten' => '<p>Penyerahan Sertifikat hasil kegiatan PTSL tahun 2017 di Kota Denpasar, di Desa Dauh Puri Kaja ada sebanyak 83 Sertifikat yg akan dibagikan ke warga sesuai terlampir</p>',
                'slug' => 'penyerahan-serifikat-ptsl-tahun-2017',
                'gambar' => 'https://s3-ap-southeast-1.amazonaws.com/dauhpurikaja/penduduk/epXUsOuRys3RED70WU899McDelxEVFYLnuxkRk5q.jpeg',
                'kategori_artikel_id' => '2',
                'type' => 'BERITA',
                'status' => '1',
                'created_at' => '2018-12-29 10:07:12',
                'updated_at' => '2018-12-29 03:44:48',
                'show_slider' => 1,
                'count_click' => 1,
            ),
            1 => 
            array (
                'id' => 4,
                'user_id' => 1,
                'judul' => 'Kegiatan Prokasih',
            'konten' => '<p>Kegiatan PROKASIH (Program Kali Bersih) yang diselenggarakan oleh Desa Dauh Puri Kaja, pada hari Minggu, 22 Oktober 2017, pukul 08.00 WITA s/d selesai. dihadiri oleh Perbekel Desa Dauh Pur',
                'slug' => 'kegiatan-prokasih',
                'gambar' => 'https://s3-ap-southeast-1.amazonaws.com/dauhpurikaja/penduduk/uhF2RoDwxcC3X2OOMeqXkPW60YoW9j6dKZk90s41.jpeg',
                'kategori_artikel_id' => '2',
                'type' => 'BERITA',
                'status' => '1',
                'created_at' => '2018-12-29 10:07:44',
                'updated_at' => '2018-12-29 03:44:38',
                'show_slider' => 1,
                'count_click' => 1,
            ),
            2 => 
            array (
                'id' => 5,
                'user_id' => 1,
                'judul' => 'Rapat Koordinasi Kepsek SD SMP',
                'konten' => '<p>Rapat pembahasan Penerimaan Peserta Didik Baru tahun ajaran 2017-2018, Perbekel dan Kepala Dusun Desa Dauh Puri Kaja Bersama Kepala Sekolah SDN 04, SDN 17, SDN 22 di ruang rapat Kantor Des',
                'slug' => 'rapat-koordinasi-kepsek-sd-smp',
                'gambar' => 'https://s3-ap-southeast-1.amazonaws.com/dauhpurikaja/penduduk/keHAnyekiTHJEt6sDRe9MTI3OnLKW45I64OQWuzn.jpeg',
                'kategori_artikel_id' => '2',
                'type' => 'BERITA',
                'status' => '1',
                'created_at' => '2018-12-29 10:08:40',
                'updated_at' => '2018-12-29 03:44:57',
                'show_slider' => 1,
                'count_click' => 4,
            ),
            3 => 
            array (
                'id' => 6,
                'user_id' => 1,
                'judul' => 'Pembinaan Sosialisasi Usaha',
                'konten' => '<p>Kegiatan "Pembinaan dan Sosialisasi Usaha Peningkatan Pendapatan Keluarga Sejahtera", untuk dapat mengembangkan Modal Usaha, Pemasaran dan Pengembangan Produk Usaha Bagi Warga Desa Dauh Pu',
                'slug' => 'pembinaan-sosialisasi-usaha',
                'gambar' => 'https://s3-ap-southeast-1.amazonaws.com/dauhpurikaja/penduduk/swVE53UF6HWeNVVZe9KZYoLfDJdLdSB6rRnzO5Gp.jpeg',
                'kategori_artikel_id' => '2',
                'type' => 'BERITA',
                'status' => '1',
                'created_at' => '2018-12-29 10:21:23',
                'updated_at' => '2018-12-29 03:45:35',
                'show_slider' => 0,
                'count_click' => 1,
            ),
        ));
        
        
    }
}
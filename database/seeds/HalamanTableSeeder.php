<?php

use Illuminate\Database\Seeder;

class HalamanTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('halaman')->delete();
        
        \DB::table('halaman')->insert(array (
            0 => 
            array (
                'id' => 1,
                'judul' => 'Sejarah',
                'tipe' => 'SEJARAH',
                'gambar' => 'https://s3-ap-southeast-1.amazonaws.com/dauhpurikaja/halaman/eTy6XoMA1WW2X3wwtJoZAhYSN4O1li96ebLovjP9.jpeg',
            'konten' => '<p><strong>SEJARAH SINGKAT DESA DAUH PURI KAJA</strong></p><p>Desa Dauh Puri Kaja pada awalnya merupakan salah satu kawasan wilayah yang berada di wilayah Pemerintahan Desa Dauh Puri, Kecamatan Denpasar Barat, Kabupaten Badung.</p><p>Dengan ditingkatkannya status Kota Denpasar menjadi Kota Administratif Kota Denpasar dan dengan perkembangan penduduk yang semakin pesat akibat kelahiran,maupun kedatangan warga baru yang kemudian menetap di wilayah Kota Administratif Kota Denpasar, maka Pemerintah memandang perlu untuk mengatur penyelenggaran Pemerintahan secara efektif guna menjamin kelancaran roda Pemerintahan. Terkait dengan hal tersebut maka dilaksanakan persiapan pembentukan Desa-Desa Persiapan sesuai dengan <strong>Surat Keputusan Bupati Kepala Daerah Tingkat II Badung tanggal 1 Desember 1979 Nomor 167 / Pem. 15/166/79 tentang Pemekaran / Pembentukan Desa-Desa Persiapan dalam wilayah Kota Administrasi Denpasar salah satunya adalah Desa Dauh Puri Kaja.</strong></p><p>Selanjutnya sesuai dengan perkembangan penduduk, mobilitas penduduk dan perkembangan wilayah, perkembangan perekonomian serta untuk lebih mengoptimalkan pelayanan kepada masyarakat didahului dengan <strong>Surat Keputusan Gubernur Kepala Daerha I Bali tanggal 1 April 1980 Nomor : 7/PEM/II.a/2.5/1980 tentang Penetapan Pemecahan Desa-Desa Dalam Wilayah Kota Denpasar </strong>dan&nbsp;pada tahun 1982 dengan <strong>Surat Keputusan Gubernur Kepala Daerah Tingkat I Bali tanggal 1 Juni 1982 Nomor 57 Tahun 1982 tentang Penetapan Desa Definitif di Wilayah Kota Administratif Denpasar, dimana salah satunya adalah Desa Dauh Puri Kaja</strong>, yang terdiri dari 5 Banjar yaitu :</p><ol><li>Br. Lumintang</li><li>Br. Wangaya Kaja</li><li>Br. Wanasari</li><li>Br. Wangaya Klod</li><li>Br. Lelangon</li></ol><p>Seiring dengan perkembangan penduduk dan mobilitas penduduk yang sangat tinggi dan perkembangan pemukiman sesuai dengan <strong>Surat Keputusan Walikotamadya Kepala Daerah Tingkat II Denpasar tanggal 22 Pebruari 1995 Nomor : 66 Tahun 1995</strong> &nbsp;di Desa Dauh Puri Kaja ditetapkan 2 (dua) dusun baru yaitu <strong>Dusun Mekarsari dan Dusun Terunasari</strong> yag sebelumnya secara administrasi kedinasannya berada di bawah Dusun Lumintang, sehingga dengan demikian saat ini Desa Dauh Puri Kaja terdiri dari 7 (tujuh) dusun yaitu :</p><ol><li>Dusun Lumintang</li><li>Dusun Wangaya Kaja</li><li>Dusun Wanasari</li><li>Dusun Wangaya Klod</li><li>Dusun Lelangon</li><li>Dusun Mekarsari</li><li>Dusun Terunasari</li></ol>',
                'slug' => 'sejarah',
                'created_at' => NULL,
                'updated_at' => '2018-12-29 11:31:01',
            ),
            1 => 
            array (
                'id' => 2,
                'judul' => 'Visi Misi',
                'tipe' => 'VISIMISI',
                'gambar' => '',
            'konten' => '<p><strong>1. VISI</strong></p><p><i><strong>“</strong></i><strong>“Melalui Tata Kelola Pemerintahan Desa Yang Baik dan Transfaran serta Berwawasan Budaya&nbsp; Didalam Membangun Desa Dauh Puri Kaja diharapkan dapat mewujudkan masyarakat yang sejahtera, adil dan harmonis”</strong></p><p>Rumusan Visi tersebut merupakan suatu ungkapan dari suatu niat yang luhur untuk memperbaiki dalam Penyelenggaraan Pemerintahan dan Pelaksanaan Pembangunan di Desa Dauh PuriKaja baik secara individu maupun kelembagaan sehingga 6( enam) tahun ke depan Desa Dauh Puri Kaja mengalami suatu perubahan yang lebih baik dan peningkatan kesejahteraan masyarakat dilihat dari segi ekonomi dengan dilandasi semangat kebersamaan dalam Penyelenggaraan Pemerintahan dan Pelaksanaan Pembangunan.</p><p><strong>2. MISI</strong></p><ol><li>&nbsp; Meningkatkan Pelayanan Kepada Masyarakat Dengan Baik Dan Efisien Menuju Kesejahteraan.</li><li>&nbsp; Mengoptimalkan Tugas, Wewenang Serta Fungsi Struktural Pemerintahan Desa &nbsp;</li><li>&nbsp; Menata Kembali Administrasi Desa</li><li>&nbsp; Menjalin Komunikasi Dan Kerjasama Dengan BPD, LPM, Lembaga Adat&nbsp; Dan&nbsp;Seluruh Kepala Dusun Desa Dauh Puri Kaja.</li><li>&nbsp; Meningkatkan Pemberdayaan Perempuan Melalui Program PKK Desa</li><li>&nbsp; Mengoptimalkan Kegiatan Pemuda Dan Olah Raga Untuk Berpartisipasi dalam&nbsp;Pembangunan Desa Dauh Puri Kaja. &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</li><li>&nbsp; Melestarikan Dan Mengembangkan Nilai – Nilai Budaya Desa</li></ol><p>&nbsp;</p>',
                'slug' => 'visi-misi',
                'created_at' => '2018-12-29 11:25:51',
                'updated_at' => '2019-01-02 15:56:43',
            ),
            2 => 
            array (
                'id' => 3,
                'judul' => 'Badan Permusyawaratan Desa',
                'tipe' => 'LEMBAGA_MASYARAKAT',
                'gambar' => '',
            'konten' => '<p><strong>Badan Permusyawaratan Desa</strong> (<strong>BPD</strong>) merupakan lembaga perwujudan demokrasi dalam penyelenggaraan <a href="https://id.wikipedia.org/wiki/Desa">pemerintahan desa</a>. BPD dapat dianggap sebagai "parlemen"-nya desa. BPD merupakan lembaga baru di desa pada era otonomi daerah di Indonesia.</p><p>Anggota BPD adalah wakil dari penduduk desa bersangkutan berdasarkan keterwakilan wilayah yang ditetapkan dengan cara musyawarah dan mufakat. Anggota BPD terdiri dari Ketua <a href="https://id.wikipedia.org/wiki/Rukun_Warga">Rukun Warga</a>, pemangku adat, golongan profesi, pemuka agama dan tokoh atau pemuka masyarakat lainnya. Masa jabatan anggota BPD adalah 6 tahun dan dapat diangkat/diusulkan kembali untuk 1 kali masa jabatan berikutnya. Pimpinan dan Anggota BPD tidak diperbolehkan merangkap jabatan sebagai Kepala Desa dan Perangkat Desa.</p><p>Peresmian anggota BPD ditetapkan dengan Keputusan <a href="https://id.wikipedia.org/wiki/Bupati">Bupati</a>/<a href="https://id.wikipedia.org/wiki/Wali_kota">Wali kota</a>, dimana sebelum memangku jabatannya mengucapkan sumpah/janji secara bersama-sama dihadapan masyarakat dan dipandu oleh Bupati/ Wali kota.</p><p>Ketua BPD dipilih dari dan oleh anggota BPD secara langsung dalam Rapat BPD yang diadakan secara khusus. BPD berfungsi menetapkan <a href="https://id.wikipedia.org/wiki/Peraturan_Desa">Peraturan Desa</a> bersama <a href="https://id.wikipedia.org/wiki/Kepala_Desa">Kepala Desa</a>, menampung dan menyalurkan aspirasi masyarakat.</p>',
                'slug' => 'badan-permusyawaratan-desa',
                'created_at' => '2019-01-01 16:18:39',
                'updated_at' => '2019-01-01 21:34:09',
            ),
            3 => 
            array (
                'id' => 4,
                'judul' => 'Lembaga Pemberdayaan Masyarakat',
                'tipe' => 'LEMBAGA_MASYARAKAT',
                'gambar' => '',
            'konten' => '<p>Berdasarkan&nbsp;<i>Peraturan Daerah Nomor 13 Tahun 2006</i>&nbsp;Tentang Lembaga Kemasyarakatan dan Lembaga Adat menyebutkan bahwa “<strong>PengertianLembaga Pemberdayaan Masyarakat</strong>&nbsp;yang selanjutnya disingkat ( LPM ) adalah lembaga,&nbsp;<strong>organisasi</strong>&nbsp;atau wadah yang di bentuk atas prakarsa masyarakat sebagai mitra pemerintah kelurahan dalam menampung dan mewujudkan aspirasi dan kebutuhan masyarakat di bidang pembangunan.</p>',
                'slug' => 'lembaga-pemberdayaan-masyarakat',
                'created_at' => '2019-01-01 21:01:57',
                'updated_at' => '2019-01-01 21:34:30',
            ),
            4 => 
            array (
                'id' => 5,
                'judul' => 'Pembinaan Kesejahtraan Keluarga',
                'tipe' => 'LEMBAGA_MASYARAKAT',
                'gambar' => '',
            'konten' => '<p>Pemberdayaan Kesejahteraan Keluarga (PKK) sebagai gerakan pembangunan masyarakat bermula dari seminar <i>Home Economic</i> di <a href="https://id.wikipedia.org/wiki/Bogor">Bogor</a> tahun 1957. Sebagai tindak lanjut dari seminar tersebut, pada tahun 1961 panitia penyusunan tata susunan pelajaran pada Pendidikan Kesejahteraan Keluarga (PKK), Kementerian Pendidikan bersama kementerian-kementerian lainnya menyusun 10 segi kehidupan keluarga. Gerakan PKK dimasyarakatkan berawal dari kepedulian istri gubernur <a href="https://id.wikipedia.org/wiki/Jawa_Tengah">Jawa Tengah</a> pada tahun 1967 (ibu Isriati Moenadi) setelah melihat keadaan masyarakat yang menderita busung lapar.</p>',
                'slug' => 'pembinaan-kesejahtraan-keluarga',
                'created_at' => '2019-01-01 21:02:44',
                'updated_at' => '2019-01-01 21:02:44',
            ),
            5 => 
            array (
                'id' => 6,
                'judul' => 'Karang Taruna',
                'tipe' => 'LEMBAGA_MASYARAKAT',
                'gambar' => '',
                'konten' => '<p><strong>Karang Taruna</strong> adalah organisasi kepemudaan di Indonesia. Karang Taruna merupakan wadah pengembangan generasi muda nonpartisan, yang tumbuh atas dasar kesadaran dan rasa tanggung jawab sosial dari, oleh dan untuk masyarakat khususnya generasi muda di wilayah Desa / Kelurahan atau komunitas sosial sederajat, yang terutama bergerak dibidang kesejahteraan sosial. Sebagai organisasi sosial kepemudaan Karang Taruna merupakan wadah pembinaan dan pengembangan serta pemberdayaan dalam upaya mengembangkan kegiatan ekonomis produktif dengan pendayagunaan semua potensi yang tersedia dilingkungan baik sumber daya manusia maupun sumber daya alam yang telah ada. Sebagai organisasi kepemudaan, Karang Taruna berpedoman pada Pedoman Dasar dan Pedoman Rumah Tangga di mana telah pula diatur tentang struktur penggurus dan masa jabatan dimasing-masing wilayah mulai dari Desa / Kelurahan sampai pada tingkat Nasional. Semua ini wujud dari pada regenerasi organisasi demi kelanjutan organisasi serta pembinaan anggota Karang Taruna baik dimasa sekarang maupun masa yang akan datang.</p>',
                'slug' => 'karang-taruna',
                'created_at' => '2019-01-01 21:05:11',
                'updated_at' => '2019-01-01 21:05:11',
            ),
            6 => 
            array (
                'id' => 7,
                'judul' => 'Perlindungan Masyarakat',
                'tipe' => 'LEMBAGA_MASYARAKAT',
                'gambar' => '',
            'konten' => '<p>Istilah Linmas yang merupakan singkatan dari Perlindungan Masyarakat telah mengalami distorsi pengertian sehingga terjebak dalam anggapan umum yang hanya mengaitkan dengan sebuah fungsi dalam masyarakat yaitu fungsi linmas atau lebih dikenal dengan Pertahanan Sipil atau Hansip.&nbsp;Merunut kepada kenyataan tersebut maka perlu di gali kembali tentang istilah dan pengertian dari Perlindungan Masyarakat dan Satuan Perlindungan Masyarakat (Satlinmas) itu sendiri.</p>',
                'slug' => 'perlindungan-masyarakat',
                'created_at' => '2019-01-01 21:06:07',
                'updated_at' => '2019-01-01 21:06:07',
            ),
            7 => 
            array (
                'id' => 8,
                'judul' => 'Lembaga Desa',
                'tipe' => 'LEMBAGA_DESA',
                'gambar' => '',
                'konten' => '<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>',
                'slug' => 'lembaga-desa',
                'created_at' => '2019-01-01 23:36:15',
                'updated_at' => '2019-01-01 23:36:15',
            ),
            8 => 
            array (
                'id' => 9,
                'judul' => 'APBDesa 2018',
                'tipe' => 'KEUANGAN',
                'gambar' => '',
                'konten' => '<p><strong>APBDESA 2017</strong></p><ul><li>PAD &nbsp; &nbsp; &nbsp; &nbsp;Rp. 43.000.000,00</li><li>DDS &nbsp; &nbsp; &nbsp; Rp. 1.025.081.143,41</li><li>BHP &nbsp; &nbsp; &nbsp; &nbsp;Rp. 1.091.018.274,52</li><li>BHR &nbsp; &nbsp; &nbsp; &nbsp;Rp. 154.089.659,61</li><li>ADD &nbsp; &nbsp; &nbsp; &nbsp;Rp. 2.468.043.605,90</li></ul><p><strong>REALISASI</strong></p><ul><li>PENYELENGGARAAN PEMERINTAHAN &nbsp; Rp. 1.798.405.160.00</li><li>PEMBANGUNAN &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Rp. 2.315.854.677,44</li><li>PEMBINAAN MASYARAKAT &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Rp. 1. 249.537.449,00</li><li>PEMBERDAYAAN MASYARAKAT &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Rp. 176.435.397,00</li><li>TAK TERDUGA &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Rp. 18.000.000,00</li></ul>',
                'slug' => 'apbdesa-2018',
                'created_at' => '2019-01-01 23:50:05',
                'updated_at' => '2019-01-02 14:36:52',
            ),
        ));
        
        
    }
}
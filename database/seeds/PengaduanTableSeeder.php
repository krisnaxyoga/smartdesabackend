<?php

use Illuminate\Database\Seeder;

class PengaduanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('pengaduans')->delete();

        \DB::table('pengaduans')->insert(array(
            0 =>
            array (
                'id' => 1,
                'desa_id' => 2,
                'penduduk_id' => 13,
                'pengaduan_category_id' => 1,
                'no_pengaduan' => '0001/ADUAN/BLKU/2020',
                'title' => 'Tes Pengaduan',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi id neque quam. Aliquam sollicitudin venenatis ipsum ac feugiat. Vestibulum ullamcorper sodales nisi nec condimentum. Mauris convallis mauris at pellentesque volutpat. Phasellus at ultricies neque, quis malesuada augue. Donec eleifend condimentum nisl eu consectetur. Integer eleifend, nisl venenatis consequat iaculis, lectus arcu malesuada sem, dapibus porta quam lacus eu neque. Morbi id neque quam. Aliquam sollicitudin venenatis ipsum ac feugiat. Vestibulum ullamcorper sodales nisi nec condimentum. Mauris convallis mauris at pellentesque volutpat. Phasellus at ultricies neque, quis malesuada augue. Donec eleifend condimentum nisl eu consectetur. Integer eleifend, nisl venenatis consequat iaculis, lectus arcu malesuada sem, dapibus porta quam lacus eu neque. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis non malesuada est, quis congue nibh. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Consectetur adipiscing elit. Morbi id neque quam. Aliquam sollicitudin venenatis ipsum ac feugiat. Vestibulum ullamcorper sodales nisi nec condimentum. Mauris convallis mauris at pellentesque volutpat. Phasellus at ultricies neque, quis malesuada augue. Donec eleifend',
                'lat' => '-8.643548303227117',
                'lng' => '115.20500202275389',
                'user_target' => NULL,
                'user_id' => NULL,
                'rating' => 24,
                'status' => 'PUBLISH',
                'start_date' => '2020-01-20',
                'end_date' => NULL,
                'photo' => 'https://s3-ap-southeast-1.amazonaws.com/smartdesa/pengaduan/9qwUBF7559fx9MYLgAIWwtoRvkJKXfnqnv3K7XUJ.png',
                'created_at' => '2020-01-20 06:02:16',
                'updated_at' => NULL,
            ),
            1 =>
            array (
                'id' => 2,
                'desa_id' => 2,
                'penduduk_id' => 13,
                'pengaduan_category_id' => 1,
                'no_pengaduan' => '0002/ADUAN/BLKU/2020',
                'title' => 'Tes Pengaduan',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi id neque quam. Aliquam sollicitudin venenatis ipsum ac feugiat. Vestibulum ullamcorper sodales nisi nec condimentum. Mauris convallis mauris at pellentesque volutpat. Phasellus at ultricies neque, quis malesuada augue. Donec eleifend condimentum nisl eu consectetur. Integer eleifend, nisl venenatis consequat iaculis, lectus arcu malesuada sem, dapibus porta quam lacus eu neque. Morbi id neque quam. Aliquam sollicitudin venenatis ipsum ac feugiat. Vestibulum ullamcorper sodales nisi nec condimentum. Mauris convallis mauris at pellentesque volutpat. Phasellus at ultricies neque, quis malesuada augue. Donec eleifend condimentum nisl eu consectetur. Integer eleifend, nisl venenatis consequat iaculis, lectus arcu malesuada sem, dapibus porta quam lacus eu neque. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis non malesuada est, quis congue nibh. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Consectetur adipiscing elit. Morbi id neque quam. Aliquam sollicitudin venenatis ipsum ac feugiat. Vestibulum ullamcorper sodales nisi nec condimentum. Mauris convallis mauris at pellentesque volutpat. Phasellus at ultricies neque, quis malesuada augue. Donec eleifend',
                'lat' => '-8.643548303227117',
                'lng' => '115.20500202275389',
                'user_target' => NULL,
                'user_id' => NULL,
                'rating' => 24,
                'status' => 'PUBLISH',
                'start_date' => '2020-01-20',
                'end_date' => NULL,
                'photo' => 'https://s3-ap-southeast-1.amazonaws.com/smartdesa/pengaduan/9qwUBF7559fx9MYLgAIWwtoRvkJKXfnqnv3K7XUJ.png',
                'created_at' => '2020-01-20 06:02:16',
                'updated_at' => '2020-03-30 13:14:39',
            ),
        ));
    }
}

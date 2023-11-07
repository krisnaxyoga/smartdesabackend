<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('categories')->delete();
        
        \DB::table('categories')->insert(array (
            0 => 
            array (
                'id' => '1',
                'category_code' => 'FBO',
                'name' => 'Fast Boat',
                'type' => 'SCHEDULE',
                'created_at' => NULL,
                'updated_at' => NULL,
                'image' => 'https://s3-ap-southeast-1.amazonaws.com/express-booking/baruna/assets/cat-fastboat.png',
            ),
            1 => 
            array (
                'id' => '2',
                'category_code' => 'ADV',
                'name' => 'Adventure',
                'type' => 'ACTIVITY',
                'created_at' => NULL,
                'updated_at' => NULL,
                'image' => 'https://s3-ap-southeast-1.amazonaws.com/express-booking/baruna/assets/cat-fastboat.jpg',
            ),
            2 => 
            array (
                'id' => '3',
                'category_code' => 'RAF',
                'name' => 'Rafting',
                'type' => 'ACTIVITY',
                'created_at' => NULL,
                'updated_at' => NULL,
                'image' => 'https://s3-ap-southeast-1.amazonaws.com/express-booking/baruna/assets/cat-rafting.jpg',
            ),
            3 => 
            array (
                'id' => '4',
                'category_code' => 'DIV',
                'name' => 'Diving',
                'type' => 'ACTIVITY',
                'created_at' => NULL,
                'updated_at' => NULL,
                'image' => 'https://s3-ap-southeast-1.amazonaws.com/express-booking/baruna/assets/cat-diving.jpg',
            ),
            4 => 
            array (
                'id' => '5',
                'category_code' => 'SNO',
                'name' => 'Snorkelling',
                'type' => 'ACTIVITY',
                'created_at' => NULL,
                'updated_at' => NULL,
                'image' => 'https://s3-ap-southeast-1.amazonaws.com/express-booking/baruna/assets/cat-snorkeling.jpeg',
            ),
            5 => 
            array (
                'id' => '6',
                'category_code' => 'CYC',
                'name' => 'Cycling',
                'type' => 'ACTIVITY',
                'created_at' => NULL,
                'updated_at' => NULL,
                'image' => 'https://s3-ap-southeast-1.amazonaws.com/express-booking/baruna/assets/cat-cycling.jpg',
            ),
            6 => 
            array (
                'id' => '7',
                'category_code' => 'TRA',
                'name' => 'Transport',
                'type' => 'ACTIVITY',
                'created_at' => NULL,
                'updated_at' => NULL,
                'image' => 'https://s3-ap-southeast-1.amazonaws.com/express-booking/baruna/assets/cat-transport.jpg',
            ),
            7 => 
            array (
                'id' => '8',
                'category_code' => 'TOP',
                'name' => 'Tour Package',
                'type' => 'ACTIVITY',
                'created_at' => NULL,
                'updated_at' => NULL,
                'image' => 'https://s3-ap-southeast-1.amazonaws.com/express-booking/baruna/assets/cat-tour.jpg',
            ),
        ));
        
        
    }
}
<?php

use Illuminate\Database\Seeder;

class MerchantsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('merchants')->delete();
        \DB::table('merchants')->insert([
            [
                'id' => '7336808c-9181-4d00-b7a8-567d9dcdb26f',
                'merchant_code' => 'elephantfastcruise',
                'name' => 'Elephant Fast Cruise',
                'legal_name' => 'PT. Ganesha Bali Utama',
                'pic' => 'I Wayan Dharmana',
                'logo' => 'https://elephantfastcruise.com/theme/img/logo/logoboat.png',
                'address' => 'Denpasar, Bali',
                'phone' => '+6281234567890',
                'email' => 'reservation@elephantfastcruise.com',
                'active' => 1
            ]
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;

class MerchantUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('merchant_users')->delete();
        \DB::table('merchant_users')->insert([
            [
                'id' => '1736a488-887b-49dd-8122-3e62f1dd52f6',
                'merchant_id' => '7336808c-9181-4d00-b7a8-567d9dcdb26f',
                'username' => 'demo',
                'password' => bcrypt('demo'),
                'name' => 'Demo',
                'email' => 'demo@example.com',
                'active' => 1
            ]
        ]);
    }
}

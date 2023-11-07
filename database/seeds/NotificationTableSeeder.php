<?php

use Illuminate\Database\Seeder;

class NotificationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('notifications')->delete();

        \DB::table('notifications')->insert(array (
            0 =>
            array (
                'id' => 1,
                'desa_id' => 1,
                'title' => 'Tes',
                'description' => 'Ini percobaan notification',
                'ref_id' => NULL,
                'ref_type' => NULL,
                'created_at' => '2020-01-06 20:21:18',
                'updated_at' => NULL,
            )
        ));

    }
}

<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('users')->delete();

        \DB::table('users')->insert(array (
            0 =>
            array (
                'id' => 1,
                'desa_id' => 1,
                'name' => 'Admin Simak Desa',
                'username' => 'admin',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token' => 'O3qLNmXeKxmAvppfhV5FmVjRWqjWywXE8L6TmoIwAvvajKQlMyfcOCFgRjBL',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 =>
            array (
                'id' => 2,
                'desa_id' => 2,
                'name' => 'Admin Desa Blahkiuh',
                'username' => 'adminblahkiuh',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token' => 'O3qLNmXeKxmAvppfhV5FmVjRWqjWywXE8L6TmoIwAvvajKQlMyfcOCFgRjBL',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));


    }
}

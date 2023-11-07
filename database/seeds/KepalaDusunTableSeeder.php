<?php

use Illuminate\Database\Seeder;

class KepalaDusunTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('kepala_dusun')->delete();
        
        \DB::table('kepala_dusun')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Made Suparsana',
                'dusun_id' => 1,
                'username' => 'suparsana',
                'pin' => '$2y$12$miBYZHXeEvQqsVRKwejtzuczfNrd.6NEicRfqLTKdK5eHw3yesuz.',
                'api_key' => 'a2FkdXNzdXBhcnNhbmE6TWFkZSBTdXBhcnNhbmE=',
                'created_at' => NULL,
                'updated_at' => '2019-04-18 10:03:53',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}
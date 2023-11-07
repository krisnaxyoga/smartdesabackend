<?php

use Illuminate\Database\Seeder;

class ShuttleAreasTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('shuttle_areas')->delete();
        
        \DB::table('shuttle_areas')->insert(array (
            0 => 
            array (
                'id' => '0775466b-909a-4f3a-8944-94e9adbc7623',
                'type' => 'PICKUP',
                'schedule_id' => '1ff4e24e-43c4-42a6-8d21-f909cb4b5409',
                'area_id' => '91280695-9fd4-45d0-a5a2-9c12925374e9',
                'duration' => 45,
                'rate' => 180000.0,
                'created_at' => '2018-07-02 07:01:44',
                'updated_at' => '2018-07-02 07:01:44',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => '0bbbe1a7-079f-49b6-8458-0bf2e4eac166',
                'type' => 'PICKUP',
                'schedule_id' => '1ff4e24e-43c4-42a6-8d21-f909cb4b5410',
                'area_id' => 'cb86fdfe-02f2-4c93-a48f-39101d18d09b',
                'duration' => 90,
                'rate' => 200000.0,
                'created_at' => '2018-07-02 07:01:44',
                'updated_at' => '2018-07-02 07:01:44',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => '0bea9ada-653c-4904-af9e-cfdaf0ad90f8',
                'type' => 'DROPOFF',
                'schedule_id' => '1ff4e24e-43c4-42a6-8d21-f909cb4b5409',
                'area_id' => '91280695-9fd4-45d0-a5a2-9c12925374e9',
                'duration' => 45,
                'rate' => 250000.0,
                'created_at' => '2018-07-02 07:01:44',
                'updated_at' => '2018-07-02 07:01:44',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => '4ece9913-dbd8-4862-a7f6-73a04f849c9f',
                'type' => 'DROPOFF',
                'schedule_id' => '1ff4e24e-43c4-42a6-8d21-f909cb4b5410',
                'area_id' => 'cb86fdfe-02f2-4c93-a48f-39101d18d09b',
                'duration' => 30,
                'rate' => 210000.0,
                'created_at' => '2018-07-02 07:01:44',
                'updated_at' => '2018-07-02 07:01:44',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}
<?php

use Illuminate\Database\Seeder;

class ScheduleRatesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('schedule_rates')->delete();
        
        \DB::table('schedule_rates')->insert(array (
            0 => 
            array (
                'id' => '6ddc986c-5770-4c73-856d-8166d730471a',
                'rate_code' => 'ONEWAY',
                'schedule_id' => '1ff4e24e-43c4-42a6-8d21-f909cb4b5409',
                'name' => 'One Way',
                'rate_adult' => 350000.0,
                'rate_child' => 250000.0,
                'publish_adult' => 350000.0,
                'publish_child' => 250000.0,
                'published' => 1,
                'created_at' => '2018-07-02 07:01:44',
                'updated_at' => '2018-07-02 07:01:44',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => '6ddc986c-5770-4c73-856d-8166d730471b',
                'rate_code' => 'ONEWAY',
                'schedule_id' => '1ff4e24e-43c4-42a6-8d21-f909cb4b5410',
                'name' => 'One Way',
                'rate_adult' => 350000.0,
                'rate_child' => 250000.0,
                'publish_adult' => 350000.0,
                'publish_child' => 250000.0,
                'published' => 1,
                'created_at' => '2018-07-02 07:01:44',
                'updated_at' => '2018-07-02 07:01:44',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => '6ddc986c-5770-4c73-856d-8166d730471c',
                'rate_code' => 'ONEWAY',
                'schedule_id' => '1ff4e24e-43c4-42a6-8d21-f909cb4b5412',
                'name' => 'One Way',
                'rate_adult' => 350000.0,
                'rate_child' => 250000.0,
                'publish_adult' => 350000.0,
                'publish_child' => 250000.0,
                'published' => 1,
                'created_at' => '2018-07-02 07:01:44',
                'updated_at' => '2018-07-02 07:01:44',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => '6ddc986c-5770-4c73-856d-8166d730471d',
                'rate_code' => 'ONEWAY',
                'schedule_id' => '1ff4e24e-43c4-42a6-8d21-f909cb4b5413',
                'name' => 'One Way',
                'rate_adult' => 350000.0,
                'rate_child' => 250000.0,
                'publish_adult' => 350000.0,
                'publish_child' => 250000.0,
                'published' => 1,
                'created_at' => '2018-07-02 07:01:44',
                'updated_at' => '2018-07-02 07:01:44',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => '6ddc986c-5770-4c73-856d-8166d730471e',
                'rate_code' => 'ONEWAY',
                'schedule_id' => '1ff4e24e-43c4-42a6-8d21-f909cb4b5414',
                'name' => 'One Way',
                'rate_adult' => 350000.0,
                'rate_child' => 250000.0,
                'publish_adult' => 350000.0,
                'publish_child' => 250000.0,
                'published' => 1,
                'created_at' => '2018-07-02 07:01:44',
                'updated_at' => '2018-07-02 07:01:44',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => '6ddc986c-5770-4c73-856d-8166d730471f',
                'rate_code' => 'ONEWAY',
                'schedule_id' => '1ff4e24e-43c4-42a6-8d21-f909cb4b5415',
                'name' => 'One Way',
                'rate_adult' => 350000.0,
                'rate_child' => 250000.0,
                'publish_adult' => 350000.0,
                'publish_child' => 250000.0,
                'published' => 1,
                'created_at' => '2018-07-02 07:01:44',
                'updated_at' => '2018-07-02 07:01:44',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => '8e405963-de88-4ffd-a3ad-a3fde247ade0',
                'rate_code' => 'ROUNDTRIP',
                'schedule_id' => '1ff4e24e-43c4-42a6-8d21-f909cb4b5409',
                'name' => 'Round Trip',
                'rate_adult' => 300000.0,
                'rate_child' => 200000.0,
                'publish_adult' => 300000.0,
                'publish_child' => 200000.0,
                'published' => 1,
                'created_at' => '2018-07-02 07:01:44',
                'updated_at' => '2018-07-02 07:01:44',
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => '8e405963-de88-4ffd-a3ad-a3fde247ade1',
                'rate_code' => 'ROUNDTRIP',
                'schedule_id' => '1ff4e24e-43c4-42a6-8d21-f909cb4b5410',
                'name' => 'Round Trip',
                'rate_adult' => 300000.0,
                'rate_child' => 200000.0,
                'publish_adult' => 300000.0,
                'publish_child' => 200000.0,
                'published' => 1,
                'created_at' => '2018-07-02 07:01:44',
                'updated_at' => '2018-07-02 07:01:44',
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => '8e405963-de88-4ffd-a3ad-a3fde247ade2',
                'rate_code' => 'ROUNDTRIP',
                'schedule_id' => '1ff4e24e-43c4-42a6-8d21-f909cb4b5412',
                'name' => 'Round Trip',
                'rate_adult' => 300000.0,
                'rate_child' => 200000.0,
                'publish_adult' => 300000.0,
                'publish_child' => 200000.0,
                'published' => 1,
                'created_at' => '2018-07-02 07:01:44',
                'updated_at' => '2018-07-02 07:01:44',
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'id' => '8e405963-de88-4ffd-a3ad-a3fde247ade4',
                'rate_code' => 'ROUNDTRIP',
                'schedule_id' => '1ff4e24e-43c4-42a6-8d21-f909cb4b5413',
                'name' => 'Round Trip',
                'rate_adult' => 300000.0,
                'rate_child' => 200000.0,
                'publish_adult' => 300000.0,
                'publish_child' => 200000.0,
                'published' => 1,
                'created_at' => '2018-07-02 07:01:44',
                'updated_at' => '2018-07-02 07:01:44',
                'deleted_at' => NULL,
            ),
            10 => 
            array (
                'id' => '8e405963-de88-4ffd-a3ad-a3fde247ade5',
                'rate_code' => 'ROUNDTRIP',
                'schedule_id' => '1ff4e24e-43c4-42a6-8d21-f909cb4b5414',
                'name' => 'Round Trip',
                'rate_adult' => 300000.0,
                'rate_child' => 200000.0,
                'publish_adult' => 300000.0,
                'publish_child' => 200000.0,
                'published' => 1,
                'created_at' => '2018-07-02 07:01:44',
                'updated_at' => '2018-07-02 07:01:44',
                'deleted_at' => NULL,
            ),
            11 => 
            array (
                'id' => '8e405963-de88-4ffd-a3ad-a3fde247ade6',
                'rate_code' => 'ROUNDTRIP',
                'schedule_id' => '1ff4e24e-43c4-42a6-8d21-f909cb4b5415',
                'name' => 'Round Trip',
                'rate_adult' => 300000.0,
                'rate_child' => 200000.0,
                'publish_adult' => 300000.0,
                'publish_child' => 200000.0,
                'published' => 1,
                'created_at' => '2018-07-02 07:01:44',
                'updated_at' => '2018-07-02 07:01:44',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}
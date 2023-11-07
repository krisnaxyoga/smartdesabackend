<?php

use Illuminate\Database\Seeder;

class PromosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('promos')->delete();
        
        \DB::table('promos')->insert(array (
            0 => 
            array (
                'id' => '1',
                'promo_code' => 'TRYELEPHANT18',
                'start_date'=>'2018-08-01',
                'start_time' => '15:00:00',
                'end_date' => NULL,
                'end_time'=> NULL,
                'product_id' => NULL,
                'stock' => NULL,
                'nominal' =>0,
                'percent'=> 10,
                'merchant_id' => '7336808c-9181-4d00-b7a8-567d9dcdb26f',

            ),
        ));
        
        
    }
}
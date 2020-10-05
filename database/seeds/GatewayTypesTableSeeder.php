<?php

use Illuminate\Database\Seeder;

class GatewayTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr = ['WING','MASTER CARD','VISA CARD'];
        foreach($arr as $type){
            DB::table('gateway_types')->insert([
                'gateway_name'=>$type
            ]);
        }

    }
}

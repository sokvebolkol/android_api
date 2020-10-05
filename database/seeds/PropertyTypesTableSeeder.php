<?php

use Illuminate\Database\Seeder;

class PropertyTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = ['Villa','Land','Condo','Building','House'];
        foreach ($array as $type){
            DB::table('property_types')->insert([
                'property_type'=>$type
                ]);
        }
    }
}

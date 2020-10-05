<?php

use Illuminate\Database\Seeder;

class ProvincesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = ['Kampong Cham','Phnome Penh','Seim Reap','Banteay Meanchey','Battambang','Kampong Chhnang','Kampong Speu','Kampong Thom','Kampot','Kandal','Koh Kong','Kratié','Mondulkiri','Phnom Penh','Preah Vihear','Prey Veng','Pursat','Ratanak Kiri','Preah Sihanouk','Steung Treng','Svay Rieng','Takéo','Oddar Meanchey','Kep','Pailin','Tboung Khmum'];
        foreach ($array as $province){
            DB::table('provinces')->insert([
                'province_name'=>$province
                ]);
        }
    }
}

<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = ['Buyer','Seller','Admin'];
        foreach ($array as $role){
            DB::table('roles')->insert([
                'role_name'=>$role
                ]);
        }
    }
}

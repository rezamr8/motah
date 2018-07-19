<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'admin',
            'label' => 'Administrator',            
        ]);

        DB::table('users')->insert([
            'name'=>'Reza Mohamad Ramdan',
            'email'=>'edzapodka@gmail.com',
            'password'=> bcrypt('gue123'),
        ]);

        DB::table('role_user')->insert([
            'role_id' => 1,
            'user_id' => 1,
        ]);
    }
}

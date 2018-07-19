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
        
        $data = [
            [
                'name'=>'Administrator',
                'email'=>'admin@motahkarya.com',
                'password'=> bcrypt('rahasia'),
            ],
            [
                'name'=>'Staff',
                'email'=>'staff@motahkarya.com',
                'password'=> bcrypt('rahasia'),
            ]
            ];
        DB::table('users')->insert($data);

        DB::table('role_user')->insert([
            'role_id' => 1,
            'user_id' => 1,
        ]);
    }
}

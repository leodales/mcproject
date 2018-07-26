<?php

use Illuminate\Database\Seeder;

class User_Table_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'admin',
            'name' => 'admin',
            'email' => str_random(10).'@gmail.com',
            'password' => bcrypt('b00kadmin'),
            'role'=> 'admin'
        ]);

        DB::table('users')->insert([
            'username' => 'production',
            'name' => 'production',
            'email' => str_random(10).'@gmail.com',
            'password' => bcrypt('pr0duction'),
            'role'=> 'production'
        ]);

        DB::table('users')->insert([
            'username' => 'finance',
            'name' => 'finance',
            'email' => str_random(10).'@gmail.com',
            'password' => bcrypt('mc0finance'),
            'role'=> 'finance'
        ]);
    }
}

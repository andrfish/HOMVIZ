<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => '1',
            'username' => 'pedram',
            'email' => 'pedramkhoshnevis@gmail.com',
            'roles' => '1',
            'password' => bcrypt('110110')
        ]);
        DB::table('users')->insert([
            'id' => '2',
            'username' => 'aidigitalsuite@gmail.com',
            'email' => 'aidigitalsuite@gmail.com',
            'roles' => '1',
            'password' => bcrypt('110110')
        ]);
        DB::table('users')->insert([
            'id' => '3',
            'username' => 'admin',
            'email' => 'example@example.com',
            'roles' => '1',
            'password' => bcrypt('110110')
        ]);
    }
}
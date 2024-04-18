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
            'username' => 'andrew',
            'email' => 'andrew.fisher@ieee.org',
            'roles' => '1',
            'password' => bcrypt('L@kehead1009')
        ]);
    }
}

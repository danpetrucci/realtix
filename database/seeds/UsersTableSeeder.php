<?php

use Illuminate\Database\Seeder;

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
            'name' => env('ADMIN_NAME_1'),
            'email' => env('ADMIN_EMAIL_1'),
            'password' => bcrypt(env('ADMIN_PASSWORD_1')),
            'role' => 'Super usuario',
            'ciudad' => 'Bogotá',
            'status' => '1'
        ]);

        DB::table('users')->insert([
            'name' => env('ADMIN_NAME_2'),
            'email' => env('ADMIN_EMAIL_2'),
            'password' => bcrypt(env('ADMIN_PASSWORD_2')),
            'role' => 'Super usuario',
            'ciudad' => 'Caracas',
            'status' => '1'
        ]);
    }
}

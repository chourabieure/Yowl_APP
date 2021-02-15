<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id'=>1,
            'name'=>'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
            'is_admin' => 1
        ]);
        DB::table('users')->insert([
            'id'=>2,
            'name'=>'user',
            'email' => 'user@user.com',
            'password' => Hash::make('user'),
            'is_admin' => 0
        ]);
    }
}

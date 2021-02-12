<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            'url'=>'empty',
            'Description' => 'description',
            'id_owner' => 1,
            'likes' => 0,
            'created_at'=> new DateTime()

        ]);
        DB::table('posts')->insert([
            'url'=>'empty',
            'Description' => 'description',
            'id_owner' => 1,
            'likes' => 0,
            'created_at'=> Carbon::parse('2021-01-05')

        ]);
        DB::table('posts')->insert([
            'url'=>'empty',
            'Description' => 'description',
            'id_owner' => 1,
            'likes' => 0,
            'created_at'=> Carbon::parse('2021-01-20')

        ]);
        DB::table('posts')->insert([
            'url'=>'empty',
            'Description' => 'description',
            'id_owner' => 2,
            'likes' => 0,
            'created_at'=> Carbon::parse('2020-12-23')

        ]);
        DB::table('posts')->insert([
            'url'=>'empty',
            'Description' => 'description',
            'id_owner' => 2,
            'likes' => 0,
            'created_at'=> Carbon::parse('2020-11-10')
        ]);
        
    }
}

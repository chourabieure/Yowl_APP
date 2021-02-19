<?php

use Illuminate\Database\Seeder;

class RelationUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('relations')->insert([
            'from'=>1,
            'to' => 2,
            'status' =>'F',
            'since'=>new DateTime()
        ]);
        DB::table('relations')->insert([
            'from'=>2,
            'to' => 1,
            'status' =>'F',
            'since'=>new DateTime()
        ]);
        DB::table('relations')->insert([
            'from'=>1,
            'to' => 4,
            'status' =>'F',
            'since'=>new DateTime()
        ]);
        DB::table('relations')->insert([
            'from'=>4,
            'to' => 1,
            'status' =>'F',
            'since'=>new DateTime()
        ]);
    }
}

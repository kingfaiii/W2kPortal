<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class users_seed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [
                "name" => "c",
                "email" => "c@gmail.com",
                "password" => bcrypt("jaudian29")
            ]
        );
    }
}

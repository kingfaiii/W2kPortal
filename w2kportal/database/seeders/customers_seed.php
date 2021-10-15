<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class customers_seed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 20; $i++) {

            DB::table('customers')->insert($this->generateCustomer());
        }
    }

    public function generateCustomer()
    {
        $faker = Factory::create();

        return [
            "customer_email" => $faker->email(),
            "customer_fname" => $faker->firstName(),
            "customer_lname" => $faker->lastName(),
            "customer_status" => $faker->randomElement(['Answered', 'Hold', 'Lost']),
            "created_at" => date('Y-m-d')
        ];
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class services_packages extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $keys = array_keys($this->generatePackage());
        for ($i = 0; $i < count($this->generatePackage()); $i++) {
            foreach ($this->generatePackage()[$keys[$i]] as $key => $package) {
                DB::table('service_packages')->insert(["package_name" => $package]);
            }
        }
    }

    public function generatePackage()
    {
        return [
            ["package_name" => "eBook & Deluxe Package"],
            ["package_name" => "Ordinary Package"],
            ["package_name" => "Super Package"],
        ];
    }
}

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
        foreach ($this->generatePackage() as $key => $package) {
            DB::table('service_packages')->insert($package);
        }
    }

    public function generatePackage()
    {
        return [
            [
                "package_name" => "eBook Basic Package",
                "sibling_id"   => 1
            ],

            [
                "package_name" => "eBook Value Package",
                "sibling_id"   => 1
            ],
            [
                "package_name" => "eBook Deluxe Package",
                "sibling_id"   => 1
            ],
            [
                "package_name" => "Print Basic Package",
                "sibling_id"   => 2
            ],
            [
                "package_name" => "Print Value Package",
                "sibling_id"   => 2
            ],
            [
                "package_name" => "Print Deluxe Package",
                "sibling_id"   => 2
            ],
            [
                "package_name" => "eBook & Print Deluxe Package",
                "sibling_id"   => 3
            ],
            [
                "package_name" => "eBook & Print Basic Package",
                "sibling_id"   => 3
            ],
            [
                "package_name" => "eBook & Print Value Package",
                "sibling_id"   => 3
            ],
            ["package_name" => "Website Development"],
            ["package_name" => "Physical To Digital/Ebook"],
            ["package_name" => "Editing Service"],
        ];
    }
}

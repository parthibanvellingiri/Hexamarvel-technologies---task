<?php

use Illuminate\Database\Seeder;

class DesignationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $designationArray = [
            [
                "designation_name" => "Managing Director",
                "short_code" => "MD",
            ],
            [
                "designation_name" => "Chief Executive Officer",
                "short_code" => "CEO",
            ]
        ];


        \App\Designation::insert($designationArray);
    }
}

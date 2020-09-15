<?php

use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $branchArray = [
            [
                "branch_name" => "Coimbatore Branch",
                "branch_id" => "HEXA001",
                "address" => "Coimbatore",
                "city" => "Coimbatore",
                "state" => "TamilNadu",
            ],
            [
                "branch_name" => "Chennai Branch",
                "branch_id" => "HEXA002",
                "address" => "Saidapet",
                "city" => "Chennai",
                "state" => "TamilNadu",
            ]
        ];


        \App\Branch::insert($branchArray);
    }
}

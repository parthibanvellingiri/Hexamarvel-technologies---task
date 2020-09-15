<?php

use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $companyArray = [
            [
                "company_name" => "ABC Company",
                "email" => "abc@gmail.com",
                "phone" => "9876543210",
            ],
            [
                "company_name" => "MNC Company",
                "email" => "abc@gmail.com",
                "phone" => "9876543210",
            ]
        ];


        \App\Company::insert($companyArray);

    }
}

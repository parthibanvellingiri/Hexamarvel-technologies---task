<?php

namespace App\Imports;

use App\UserManagement;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use function GuzzleHttp\Psr7\str;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new UserManagement([

            //
            'name'     => $row['name'],
            'email'    => $row['email'],
            'phone'     => $row['phone'],
            'gender'     => $row['gender'],
            'dob'     => Date::excelToDateTimeObject($row['dob']),
            'doj'     => Date::excelToDateTimeObject($row['doj']),

        ]);
    }
}

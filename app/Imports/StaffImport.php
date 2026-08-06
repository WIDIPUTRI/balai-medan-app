<?php

namespace App\Imports;

use App\Models\Staff;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\ToModel;

class StaffImport implements ToModel
{
    public function model(array $row)
    {
        return new Staff([
            'name'        => $row[0],
            'gender'      => $row[1],
            'birth_place' => $row[2],
            'birth_date'  => $row[3],
            'education'   => $row[4],
            'rank'        => $row[5],
            'position'    => $row[6],
        ]);
    }
}

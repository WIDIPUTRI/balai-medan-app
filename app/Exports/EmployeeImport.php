<?php

namespace App\Imports;


use App\Models\Employee;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class EmployeeImport implements ToModel, WithHeadingRow
{
public function model(array $row)
{
return new Employee([
'name' => $row['name'] ?? null,
'gender' => $row['gender'] ?? null,
'birthplace' => $row['birthplace'] ?? null,
'birthdate' => isset($row['birthdate']) ? \Carbon\Carbon::parse($row['birthdate'])->format('Y-m-d') : null,
'education' => $row['education'] ?? null,
'rank' => $row['rank'] ?? null,
'position' => $row['position'] ?? null,
]);
}
}
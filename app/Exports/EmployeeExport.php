<?php

namespace App\Exports;


use App\Models\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class EmployeeExport implements FromCollection, WithHeadings
{
public function collection()
{
return Employee::select('name','gender','birthplace','birthdate','education','rank','position')->get();
}


public function headings(): array
{
return ['name','gender','birthplace','birthdate','education','rank','position'];
}
}
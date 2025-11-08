<?php

namespace App\Imports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class StudentsImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Student([
            'name'     => $row['nama'],
            'nis'      => $row['nis'],
            'class'    => $row['kelas'],
        ]);
    }

    public function rules(): array
    {
        return [
            'nama' => 'required|string',
            'nis' => 'required|numeric|unique:students,nis',
            'kelas' => 'required|string',
        ];
    }
}


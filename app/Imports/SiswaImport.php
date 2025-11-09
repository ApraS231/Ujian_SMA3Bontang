<?php

namespace App\Imports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class SiswaImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Siswa([
            'name'     => $row['nama'],
            'nis'      => $row['nis'],
            'class'    => $row['kelas'],
        ]);
    }

    public function rules(): array
    {
        return [
            'nama' => 'required|string',
            'nis' => 'required|numeric|unique:siswas,nis',
            'kelas' => 'required|string',
        ];
    }
}

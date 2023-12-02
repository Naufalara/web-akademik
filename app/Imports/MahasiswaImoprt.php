<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Mahasiswa; // Add this line to import the Mahasiswa model
use Maatwebsite\Excel\Concerns\ToModel;

class MahasiswaImoprt implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new User([
            'id' => $row[0],
            'nip' => $row[1],
            'name' => $row[2],
            'email' => $row[3],
            'password' => $row[4],
            'role' => $row[5],
        ]);
    }
}

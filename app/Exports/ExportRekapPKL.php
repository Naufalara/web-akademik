<?php

namespace App\Exports;

use App\Models\pkl;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportRekapPKL implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return pkl::all();
    }
}

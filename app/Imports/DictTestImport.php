<?php

namespace App\Imports;

use App\Models\Dict;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;

class DictTestImport implements ToModel
{
    public function model(array $row)
    {
        return new Dict([
            'text' => $row[1],
            'locale' => $row[2],
            'ids' => $row[3],
        ]);
    }
}

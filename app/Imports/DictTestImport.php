<?php

namespace App\Imports;

use App\Models\Dict;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;

class DictTestImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

            Dict::firstOrCreate([
                'text' => $row[1],
                'locale' => $row[2],
                'ids' => $row[3],

            ]);
        }
    }
}

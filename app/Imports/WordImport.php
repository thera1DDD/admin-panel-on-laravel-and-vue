<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\Word;

class WordImport implements ToModel
{
    public function model(array $row): Word
    {
        return Word::firstOrCreate(['name' => $row[0]]);
    }
}

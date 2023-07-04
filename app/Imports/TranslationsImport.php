<?php

namespace App\Imports;

use App\Models\Language;
use App\Models\Translate;
use App\Models\Word;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TranslationsImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $language = Language::firstOrCreate(['name' => $row[2]]);
            $word = Word::firstOrCreate(['name' => $row[0]]);
            $translate = new Translate();
            $translate->words_id = $word->id;
            $translate->translate = $row[1];
            $translate->languages_id = $language->id;
            $translate->save();
        }
    }
}

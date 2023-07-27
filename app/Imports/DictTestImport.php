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
            // Здесь вы можете обработать каждую строку из файла
            // Например, добавить данные в базу данных
            Dict::firstOrCreate([
                'text' => $row[1], // Предполагаем, что текст находится в первой колонке (индекс 0)
                'locale' => $row[2], // Предполагаем, что текст находится в первой колонке (индекс 0)
                'ids' => $row[3], // Предполагаем, что текст находится в первой колонке (индекс 0)
                // Здесь вы можете добавить другие поля, если они есть в файле
            ]);
        }
    }
}

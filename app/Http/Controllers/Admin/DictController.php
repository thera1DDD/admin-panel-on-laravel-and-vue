<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\DictTestImport;
use App\Models\Dict;
use App\Models\Translate;
use App\Models\Word;
use Illuminate\Http\Request;
use App\Jobs\ProcessUploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Facades\Excel;


class DictController extends Controller
{
   public function index(Request $request){
       $dicts = Dict::query();
       if ($request->has('query')) {
           $query = $request->input('query');
           $dicts->where('id', 'like', "%{$query}%");
       }
       $dicts = $dicts->paginate(40);
       return view('dict.index',compact('dicts'));
   }

    public function import(Request $request)
    {
        $file = $request->file('file');

        if ($file && $file->getClientOriginalExtension() === 'xlsx') {
            try {
                $data = Excel::toArray(new DictTestImport(), $file);

                if (count($data) > 0) {
                    // Разделяем данные на пакеты по 1000 записей
                    $chunks = array_chunk($data[0], 1000);

                    foreach ($chunks as $chunk) {
                        $insertData = [];

                        foreach ($chunk as $row) {
                            $insertData[] = [
                                'text' => $row[1], // Первый столбец в файле Excel
                                'locale' => $row[2], // Второй столбец в файле Excel
                                'ids' => $row[3], // Третий столбец в файле Excel
                            ];
                        }

                        // Используем транзакцию для массовой вставки данных
                        DB::transaction(function () use ($insertData) {
                            DB::table('dicts')->insert($insertData);
                        });
                    }
                }
            } catch (\Exception $e) {
                // Обработка ошибок при импорте
                return back()->withError('Произошла ошибка при импорте данных: ' . $e->getMessage());
            }

            return redirect()->route('dict.index')->withSuccess('Данные успешно импортированы');
        } else {
            return back()->withError('Некорректный файл. Пожалуйста, загрузите файл с расширением .xlsx');
        }
    }

    public function delete(Dict $dict){
        $dict->delete();
        return redirect()->route('dict.index')->with('success','Dict удаленно');
    }
}

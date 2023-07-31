<?php

namespace App\Console\Commands;

use App\Models\Language;
use App\Models\Translate;
use App\Models\Word;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class TransferDictData extends Command
{
    protected $signature = 'dict:transfer';

    public function handle()
    {
        $dictItems = DB::table('dicts')->get();

        // Миграция данных в таблицу words и translates
        foreach ($dictItems as $item) {
            if ($item->locale === 'ru') {
                Word::firstOrCreate([
                    'id' => $item->id,
                    'name' => $item->text,
                ]);
            } else {
                $translationIds = explode(',', $item->ids);
                foreach ($translationIds as $translationId) {
                    $language = Language::where('name', $item->locale === 'lz' ? 'Лезгинский' : 'Аварский')->first();
                    if ($language) {
                        Translate::create([
                            'id' => $item->id,
                            'words_id' => $translationId,
                            'translate' => $item->text,
                            'languages_id' => $language->id,
                        ]);

                    }
                }
            }
        }
        $this->info('Данные успешно перемещенны');
    }
}

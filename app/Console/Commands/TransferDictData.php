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

        foreach ($dictItems as $item) {
            if ($item->locale === 'ru') {
                Word::firstOrCreate([
                    'id' => $item->id,
                    'name' => $item->text,
                ]);
            } else {
                $translationIds = explode(',', $item->ids);
                foreach ($translationIds as $translationId) {
                    $language = $this->getLanguageByName($item->locale);
                    if ($language) {
                        Translate::create([
                            'id' => $item->id,
                            'words_id' => $translationId ?? null,
                            'translate' => $item->text,
                            'languages_id' => $language->id,
                        ]);
                    }
                }
            }
        }
        DB::table('dicts')->delete();
        $this->info('Данные успешно перенесенны');
    }

    private function getLanguageByName($name)
    {
        $languageNames = [
            'lz' => 'Лезгинский',
            'av' => 'Аварский',
            'lk' => 'Лакский',
            'km' => 'Кумыкский',
        ];

        if (isset($languageNames[$name])) {
            return Language::where('name', $languageNames[$name])->first();
        }


        return null;
    }
}


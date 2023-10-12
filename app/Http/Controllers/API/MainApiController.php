<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\Dictionary\BackwardsTranslateResource;
use App\Http\Resources\Dictionary\OrdinaryTranslateResource;
use App\Http\Resources\Dictionary\TranslateResource;
use App\Http\Resources\Dictionary\WordResource;
use App\Models\Translate;
use App\Models\Word;
use App\Traits\HttpResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;


class MainApiController extends Controller
{
   use HttpResponse;

//Dictionary stuff start
   public function translate(int $id,$languages_id){
       $words = Translate::where('words_id', $id)->where('languages_id', $languages_id)->get();
       if (isset($words)) {
           return TranslateResource::collection($words);
       }
       else {
           return $this->error('there is no such a word', 404);
       }
   }

    public function search($word, $languages_id)
    {
        if ($word) {
            $cacheKey = 'word_ids_' . $word;

            $wordIds = Cache::remember($cacheKey, now()->addMinutes(10), function () use ($word) {
                return Word::where('name', 'like', "$word%")->pluck('id')->toArray();
            });

            $cacheKey = 'word_translation_' . implode('_', $wordIds) . '_' . $languages_id;

            $result = Cache::remember($cacheKey, now()->addMinutes(10), function () use ($word, $wordIds, $languages_id) {
                $translations = Translate::whereIn('words_id', $wordIds)
                    ->where('languages_id', $languages_id)
                    ->select('words_id', 'translate')
                    ->get()
                    ->groupBy('words_id');

                $searchedWord = Word::where('name', $word)
                    ->whereIn('id', $wordIds)
                    ->first();

                $searchedWordData = $searchedWord ? [
                    'id' => $searchedWord->id,
                    'word' => $searchedWord->name,
                    'translate' => $translations->get($searchedWord->id)->pluck('translate')->implode(', '),
                ] : null;

                $otherWords = collect($wordIds)
                    ->reject(function ($wordId) use ($searchedWord) {
                        return $wordId === ($searchedWord ? $searchedWord->id : null);
                    })
                    ->map(function ($wordId) use ($translations) {
                        $word = Word::find($wordId);
                        $translates = $translations->get($wordId);
                        $translate = $translates ? $translates->pluck('translate')->implode(', ') : null;

                        return [
                            'id' => $word->id,
                            'word' => $word->name,
                            'translate' => $translate,
                        ];
                    });

                if ($searchedWordData) {
                    return collect([$searchedWordData])->concat($otherWords);
                }

                return collect($otherWords);
            });

            return response()->json(['data' => $result]);
        }
    }




    public function searchBackward($word, $languages_id)
    {
        if ($word) {
            $translate = Translate::query();

            $data = $translate->with('word')
                ->select('translate', 'languages_id', 'words_id')
                ->where('languages_id', $languages_id)
                ->where(function ($query) use ($word) {
                    $query->where('translate', 'like', "{$word}%")
                        ->orWhereHas('word', function ($query) use ($word) {
                            $query->where('name', 'like', "{$word}%");
                        });
                })
                ->orderByRaw("CASE
                WHEN `translate` = ? THEN 1
                ELSE 2
            END, `translate`", [$word])
                ->paginate(10);

            return BackwardsTranslateResource::collection($data);
        }
    }






    public function getAllBackwardWords($languages_id){
       $translate = Translate::with('word')->where('languages_id',$languages_id)->paginate(40);
       return BackwardsTranslateResource::collection($translate);
   }
    public function getAllOrdinaryWords($languages_id){
        $translate = Translate::with('word')->where('languages_id', $languages_id)->paginate(40);
        return OrdinaryTranslateResource::collection($translate);
    }
//end Dictionary stuff
}





//public function translateBackward(int $id,string $languages_id){
//    $translate = Translate::where('languages_id',$languages_id)->where('id',$id)->first();
//    if($translate){
//        return new WordResource($translate->word);
//    }
//    else{
//        return $this->error('there is no translate',404);
//    }
//}

//public function searchBackward($word, $languages_id)
//{
//    $word = trim(htmlspecialchars($word));
//    $cacheKey = "search_backward_{$word}_{$languages_id}";
//    if ($word) {
//        $data = Cache::remember($cacheKey, now()->addMinutes(5), function () use ($word, $languages_id) {
//            return Translate::with('word')
//                ->where('translate', 'like', "%{$word}%")
//                ->where('languages_id', $languages_id)
//                ->get(['id', 'translate', 'words_id']);
//        });
//        return BackwardsTranslateResource::collection($data);
//    }
//}



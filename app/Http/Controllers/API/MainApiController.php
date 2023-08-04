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

    public function search($word,$languages_id){
        if ($word) {
            $query = Word::query();
            $data = $query->where('name', 'like', "%{$word}%")->get();
            $result = [];
            foreach ($data as $word) {
                $translate = $word->translate()
                    ->where('languages_id', $languages_id)
                    ->pluck('translate')
                    ->toArray();

                $result[] = [
                    'id' => $word->id,
                    'word' => $word->name,
                    'translate' => count($translate) > 0 ? implode(', ', $translate) : null,
                ];
            }
            return response()->json(['data'=>$result]);
        }
    }
    public function searchBackward($word,$languages_id){
        $translate = Translate::query();
        if ($word) {
            $data =  $translate->with('word')->where('translate', 'like', "%{$word}%")->where('languages_id',$languages_id)->get();
            return  BackwardsTranslateResource::collection($data);
        }
    }

   public function translateBackward(int $id,string $languages_id){
       $translate = Translate::where('languages_id',$languages_id)->where('id',$id)->first();
       if($translate){
           return new WordResource($translate->word);
       }
       else{
           return $this->error('there is no translate',404);
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

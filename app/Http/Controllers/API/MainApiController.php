<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\Dictionary\TranslateResource;
use App\Http\Resources\Dictionary\WordResource;
use App\Models\Translate;
use App\Models\Word;
use App\Traits\HttpResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class MainApiController extends Controller
{
   use HttpResponse;

//Dictionary stuff start
   public function translate(int $id,$language){
       $words = Translate::where('words_id', $id)->where('language', $language)->get();
       if (isset($words)) {
           return TranslateResource::collection($words);
       }
       else {
           return $this->error('there is no such a word', 404);
       }
   }

    public function search($word){
        $words = Word::query();
        if ($word) {
            $data =  $words->where('name', 'like', "%{$word}%")->get();
            return  WordResource::collection($data);
        }
    }
    public function searchBackward($word,$language){
        $translate = Translate::query();
        if ($word) {
            $data =  $translate->where('translate', 'like', "%{$word}%")->where('language',$language)->get();
            return  TranslateResource::collection($data);
        }
    }

   public function translateBackward(int $id,string $language){
       $translate = Translate::where('language',$language)->where('id',$id)->first();
       if($translate){
           return new WordResource($translate->word);
       }
       else{
           return $this->error('there is no translate',404);
       }
   }

   public function getAllWords($language){
       $translate = Translate::where('language','=',$language)->get();
       return TranslateResource::collection($translate);
   }
//end Dictionary stuff
}

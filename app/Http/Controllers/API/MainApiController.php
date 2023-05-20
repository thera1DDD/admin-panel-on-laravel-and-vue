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
   public function translate(string $dictionaryType,int $id,$language){
       if($dictionaryType=='ru-lez'){
           $words = Translate::where('words_id',$id)->where('language',$language)->get();
           if(isset($words)){
               return TranslateResource::collection($words);
           }
           else{
               return $this->error('there is no such a word',404);
           }
       }
       elseif($dictionaryType=='ru-avar'){
           $words = Translate::where('words_id',$id)->where('language',$language)->get();
           if(isset($words)){
               return TranslateResource::collection($words);
           }
           else{
               return $this->error('there is no such a word',404);
           }
       }
       else{
           return $this->error('there is no such a dictionary',404);
       }
   }

   public function translateBackward(string $dictionaryType,int $id,string $language){
     if($dictionaryType=='lez-ru'){
       $translate = Translate::where('language',$language)->where('id',$id)->first();
       return $translate->word->name;
     }
     elseif($dictionaryType=='avar-ru'){
         $translate = Translate::where('language',$language)->where('id',$id)->first();
         return $translate->word->name;
     }
   }

   public function getAllWords($dictionaryType,$language){
       if ($dictionaryType=='lez-ru'){
           $translate = Translate::where('language','=',$language)->get();
           return TranslateResource::collection($translate);
       }
       elseif ($dictionaryType=='avar-ru'){
           $translate = Translate::where('language','=',$language)->get();
           return TranslateResource::collection($translate);
       }
       else{
           return $this->error('there is no such a dictionary',404);
       }
   }
//end Word stuff
}

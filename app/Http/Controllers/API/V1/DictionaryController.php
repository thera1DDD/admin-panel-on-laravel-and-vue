<?php

namespace App\Http\Controllers\API\V1;


use App\Http\Controllers\API\MainApiController;
use App\Http\Resources\Dictionary\SwitchResource;
use App\Models\SwitchLang;

class DictionaryController extends MainApiController
{
    public function getAll(string $dictionaryType,$languages_id){
        switch ($dictionaryType){
            case(str_starts_with($dictionaryType,'ru'));
                return $this->getAllOrdinaryWords($languages_id);
            case (!str_starts_with($dictionaryType,'ru'));
                return $this->getAllBackwardWords($languages_id);
            default: return  $this->error('dictionary not found',404);
        }
    }

    public function getSearch(string $dictionaryType,int $languages_id, string $word){
        switch ($dictionaryType){
            case(str_starts_with($dictionaryType,'ru'));
                return $this->search($word,$languages_id);
            case (!str_starts_with($dictionaryType,'ru'));
                return $this->searchBackward($word,$languages_id);
            default: return  $this->error('dictionary not found',404);
        }
    }

    public function getSwithes(){
        $switch = SwitchLang::all();
        if(isset($switch)){
            return SwitchResource::collection($switch);
        }
        else{
            return $this->error('switches not found',404);
        }
    }







//    public function getTranslate(string $dictionaryType,int $id){
//        return match ($dictionaryType) {
//            'ru-lez' => $this->translate($id,'Лезгинский'),
//                'ru-avar' => $this->translate(  $id,'Аварский'),
//                    'lez-ru' => $this->translateBackward($id,'Лезгинский'),
//                        'avar-ru' => $this->translateBackward($id,'Аварский') ,
//                             default => $this->error('wrong dictionary type', 404),
//        };
//    }

}

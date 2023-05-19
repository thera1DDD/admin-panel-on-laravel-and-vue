<?php

namespace App\Http\Controllers\API\V1;


use App\Http\Controllers\API\MainApiController;
use App\Http\Controllers\Controller;
use App\Http\Resources\Dictionary\TranslateResource;
use App\Http\Resources\Dictionary\WordResource;
use App\Http\Resources\Test\TestResource;
use App\Http\Resources\Teacher\TeacherResource;
use App\Models\Course;
use App\Models\Teacher;
use App\Models\Test;
use App\Models\Translate;
use App\Models\Word;
use Illuminate\Http\Request;

class DictionaryController extends MainApiController
{
    public function getAll(string $dictionaryType){
        if($dictionaryType=='lez-ru'){
            return $this->getAllWords($dictionaryType,'Лезгинский');
        }
        elseif ($dictionaryType=='avar-ru'){
            return $this->getAllWords($dictionaryType,'Аварский');
        }
        elseif($dictionaryType=='ru-lez' || 'ru-avar'){
            $words = Word::all();
            return WordResource::collection($words);
        }
        else{
            return  $this->error('words not found',404);
        }
    }

    public function getTranslate(string $dictionaryType,int $id){
        if($dictionaryType == 'ru-lez') {
            return $this->translate($dictionaryType,$id,'Лезгинский');
        }
        elseif ($dictionaryType == 'ru-avar'){
            return $this->translate($dictionaryType,$id,'Аварский');
        }
        if($dictionaryType == 'lez-ru'){
            return $this->translateBackward($dictionaryType,$id,'Лезгинский');
        }
        elseif ($dictionaryType == 'avar-ru'){
            return $this->translateBackward($dictionaryType,$id,'Аварский');
        }
    }
}

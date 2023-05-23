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
use http\Env\Response;
use Illuminate\Http\Request;

class DictionaryController extends MainApiController
{
    public function getAll(string $dictionaryType){
        switch ($dictionaryType){
            case('lez-ru');
                return $this->getAllWords('Лезгинский');
            case('avar-ru');
                return $this->getAllWords('Аварский');
            case ('ru-lez' or 'ru-avar');
                $words = Word::all();
                 return WordResource::collection($words);
            default: return  $this->error('dictionary not found',404);
        }
    }

    public function getTranslate(string $dictionaryType,int $id){
        return match ($dictionaryType) {
            'ru-lez' => $this->translate($id,'Лезгинский'),
                'ru-avar' => $this->translate(  $id,'Аварский'),
                    'lez-ru' => $this->translateBackward($id,'Лезгинский'),
                        'avar-ru' => $this->translateBackward($id,'Аварский') ,
                             default => $this->error('wrong dictionary type', 404),
        };
    }

    public function getSearch(string $dictionaryType, string $word){
        switch ($dictionaryType){
            case('lez-ru');
                return $this->searchBackward($word,'Лезгинский');
            case('avar-ru');
                return $this->searchBackward($word,'Аварский');
            case('ru-lez' || 'ru-avar');
                return $this->search($word);
            default: return  $this->error('dictionary not found',404);
        }
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyAnswer extends Model
{
    protected $table = 'survey_answers';
    protected $guarded = false;

    public function survey_questions(){
        return $this->belongsTo(SurveyQuestion::class,'survey_questions_id','id');
    }
}

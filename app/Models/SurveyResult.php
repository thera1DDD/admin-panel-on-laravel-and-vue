<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyResult extends Model
{
    protected $table = 'survey_results';
    protected $guarded = false;

    public function survey_questions(){
        return $this->belongsTo(SurveyQuestion::class,'survey_questions_id','id');
    }
    public function survey_answers(){
        return $this->belongsTo(SurveyAnswer::class,'survey_answers_id','id');
    }
}

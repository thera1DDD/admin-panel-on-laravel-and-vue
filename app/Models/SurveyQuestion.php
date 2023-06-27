<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyQuestion extends Model
{
    protected $table = 'survey_questions';
    protected $guarded = false;


    public function survey_answer()
    {
        return $this->hasMany(SurveyAnswer::class, 'survey_questions_id');
    }
}

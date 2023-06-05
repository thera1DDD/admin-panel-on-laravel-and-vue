<?php

namespace App\Service;

use App\Http\Controllers\Controller;
use App\Models\PopularQuestion;
use App\Models\Upgrade;

class PopularQuestionService extends Controller
{
    public function store($data){
        PopularQuestion::firstOrCreate($data);
    }

    public function update($data,PopularQuestion $popularQuestion){
        $popularQuestion->update($data);
    }
}

<?php

namespace App\Service;

use App\Events\UserAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Language\UpdateRequest;
use App\Models\Language;
use App\Models\Teacher;

class TeacherService extends Controller
{
    public function store($data){
        event(new UserAction(auth()->user()->id, 'Добавление','Учителя',$data['position']));
        Teacher::firstOrCreate($data);
    }

    public function update($data, Teacher $teacher ){
        event(new UserAction(auth()->user()->id, 'Обновление','Учителя',$data['position']));
        $teacher->update($data);
    }
}

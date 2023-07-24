<?php

namespace App\Service;

use App\Events\UserAction;
use App\Http\Controllers\Controller;
use App\Models\Course;

class CourseService extends Controller
{
    public function store($data){
        event(new UserAction(auth()->user()->id, 'Добавление','Курсы',$data['name']));
        Course::firstOrCreate($data);
    }

    public function update(Course $course,$data){
        event(new UserAction(auth()->user()->id, 'Обновление','Курсы',$data['name']));
        $course->update($data);
    }
}

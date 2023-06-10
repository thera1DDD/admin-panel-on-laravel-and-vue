<?php

namespace App\Service;

use App\Http\Controllers\Controller;
use App\Models\Course;

class CourseService extends Controller
{
    public function store($data){
        Course::firstOrCreate($data);
    }

    public function update(Course $course,$data){
        $course->update($data);
    }
}

<?php

namespace App\Service;

use App\Http\Controllers\Controller;
use App\Models\Course;

class CourseService extends Controller
{
    public function store($data){

        $main_image = $data['main_image'];
        $main_image_name = time() . '_' . $main_image->getClientOriginalName();
        $main_image_file_path = $main_image->storeAs('images/courses', $main_image_name, 'public');
        $data['main_image'] = $main_image_file_path;
        Course::firstOrCreate($data);
    }

    public function update($course,$data){
        $course->update($data);
    }
}

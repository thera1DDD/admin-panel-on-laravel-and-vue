<?php

namespace App\Service\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Course\StoreRequest;
use App\Http\Requests\Course\UpdateRequest;
use App\Models\Course;
use App\Models\Language;
use Illuminate\Support\Facades\Storage;

class CourseService extends Controller
{
    public function store($data){


        Course::firstOrCreate($data);
    }

    public function update(UpdateRequest $request,Course $course ){
        $data = $request->validated();
        $data['main_image'] = Storage::disk('public')->put('/images/courses',$data['main_image']);
        $course->update($data);
    }
}

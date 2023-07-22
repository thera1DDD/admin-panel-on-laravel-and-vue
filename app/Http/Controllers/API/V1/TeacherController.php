<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Teacher\TeacherResource;
use App\Models\Teacher;


class TeacherController extends Controller
{
    public function getAll(){
        $teachers = Teacher::with('user',)->get();
        return TeacherResource::collection($teachers);
    }
}


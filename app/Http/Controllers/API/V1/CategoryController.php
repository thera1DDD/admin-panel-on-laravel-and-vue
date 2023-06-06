<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\API\MainApiController;
use App\Http\Controllers\Controller;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Course\CourseResource;
use App\Http\Resources\Course\ModuleResource;
use App\Http\Resources\Course\SingleCourseResource;
use App\Models\Category;
use App\Models\Course;
use App\Models\Module;
use App\Models\Stat;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\AssignOp\Mod;

class CategoryController extends MainApiController
{
    public function getAll($location){
        $category = Category::where('type','=',$location)->get();
        return CategoryResource::collection($category);
    }
}

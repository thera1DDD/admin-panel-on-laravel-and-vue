<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\API\MainApiController;
use App\Http\Controllers\Controller;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Category\ColumnResource;
use App\Http\Resources\Course\CourseResource;
use App\Http\Resources\Course\ModuleResource;
use App\Http\Resources\Course\SingleCourseResource;
use App\Models\Category;
use App\Models\Column;
use App\Models\Course;
use App\Models\Module;
use App\Models\Stat;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\AssignOp\Mod;

class CategoryController extends MainApiController
{
    public function getAll($location){
        if($location=='header' || 'menu'){
            $categories = Category::where('location',$location)->get();
            return CategoryResource::collection($categories);
        }
        else{
            $columns = Column::with(['category' => function ($query) use ($location) {
                $query->where('location', $location);
            }])->get();
            return ColumnResource::collection($columns);
        }
    }
}

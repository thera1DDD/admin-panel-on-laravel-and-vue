<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\API\MainApiController;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Category\ColumnResource;
use App\Models\Category;
use App\Models\Column;

class CategoryController extends MainApiController
{
    public function getAll($location){
        if($location =='menu' or $location == 'underMenu'){
            $categories = Category::select('id', 'name', 'path','poster','location')
                ->where('location', $location)
                ->get();
            return new CategoryResource([
                'data' => $categories,
                'additional' => $categories
            ]);
        }
       elseif($location == 'header'){
            $categories = Category::select('id', 'name', 'path','poster','location')
                ->where('location', $location)
                ->get();
           $categoriesAdditional = Category::select('id', 'name', 'path','poster','location')
               ->where('location', 'headerAdditional')
               ->get();
            return new CategoryResource([
                'data' => $categories,
                'additional' => $categoriesAdditional
            ]);
        }
        else{
            $columns = Column::with(['category' => function ($query) use ($location) {
                $query->where('location', $location);
            }])->get();
            return ColumnResource::collection($columns);
        }
    }
}

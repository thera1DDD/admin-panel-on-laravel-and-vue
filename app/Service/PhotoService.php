<?php

namespace App\Service;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use App\Models\Question;

class PhotoService extends Controller
{
    public function store($data){

        $photo = new Photo();
        $photo->filename = $data['filename'];
        $photo->photoable_id = $data['photoable_id'];
        $photoable_id = $data['photoable_id'];
        $photoable_type = "App\Models\\" . $data['photoable_type'];
        $model = $photoable_type::findOrFail($photoable_id);
        $photo->photoable()->associate($model);
        $photo->save();
    }

    public function update($data,Photo $photo){
        if(isset($data['filename'])){
            $photo->filename = $data['filename'];
        }
        $photo->photoable_id = $data['photoable_id'];
        $photoable_id = $data['photoable_id'];
        $photoable_type = "App\Models\\" .$data['photoable_type'];
        $model = $photoable_type::findOrFail($photoable_id);
        $photo->photoable()->associate($model);
        $photo->update();
    }
}

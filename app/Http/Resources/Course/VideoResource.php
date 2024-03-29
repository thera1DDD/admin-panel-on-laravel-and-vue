<?php

namespace App\Http\Resources\Course;

use Illuminate\Http\Resources\Json\JsonResource;

class VideoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return[
            'id'=>$this->id,
            'name'=>$this->name,
            'number'=>$this->number,
            'description'=>$this->description,

            'poster'=>$this->poster,
            'code'=>$this->code,
            'type'=>'video',
            'video_file'=>$this->video_file,
            'passed' => isset($this->passed) ? $this->passed : false,

        ];
    }
}

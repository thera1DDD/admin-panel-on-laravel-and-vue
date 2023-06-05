<?php

namespace App\Http\Resources\Course;

use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
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
            'main_image'=>$this->main_image,
            'sort'=>$this->sort,
            'totalVideos' => $this->totalVideos ?? null,
            'totalTests' => $this->totalTests ?? null,
            'totalTasks' => $this->totalTasks ?? null,
            'totalExam'=>$this->totalExam ?? null,
            'passedVideos' => $this->passedVideos ?? null,
            'passedTasks'=>$this->passedTasks ?? null,
            'module' => SingleModuleResource::collection($this->whenLoaded('module')),

        ];
    }
}

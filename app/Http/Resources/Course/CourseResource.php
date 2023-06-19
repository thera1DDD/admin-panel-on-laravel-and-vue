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
            'code'=>$this->code,
            'name'=>$this->name,
            'main_image'=>$this->main_image,
            'sort'=>$this->sort,
            'total_videos' => $this->totalVideos ?? null,
            'total_tests' => $this->totalTests ?? null,
            'total_tasks' => $this->totalTasks ?? null,
            'total_exam'=>$this->totalExam ?? null,
            'passed_videos' => $this->passedVideos ?? null,
            'passed_tasks'=>$this->passedTasks ?? null,
            'modules' => SingleModuleResource::collection($this->whenLoaded('module'))->toArray($request),
        ];
    }
}

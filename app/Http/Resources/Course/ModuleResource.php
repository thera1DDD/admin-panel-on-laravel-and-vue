<?php

namespace App\Http\Resources\Course;

use Illuminate\Http\Resources\Json\JsonResource;

class ModuleResource extends JsonResource
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
            'number'=>$this->number,
            'tests' => TestResource::collection($this->whenLoaded('test')),
            'videos' => VideoResource::collection($this->whenLoaded('video')),
            'tasks' => TaskResource::collection($this->whenLoaded('task')),
        ];
    }
}

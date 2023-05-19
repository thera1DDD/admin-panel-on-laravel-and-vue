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
            'name'=>$this->name,
            'main_image'=>$this->main_image,
            'sort'=>$this->sort,
            'number'=>$this->number,
            'test' => TestResource::collection($this->whenLoaded('test')),
            'video' => VideoResource::collection($this->whenLoaded('video')),
            'task' => TaskResource::collection($this->whenLoaded('task')),
        ];
    }
}

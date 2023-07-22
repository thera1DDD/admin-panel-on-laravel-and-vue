<?php

namespace App\Http\Resources\Course;

use Illuminate\Http\Resources\Json\JsonResource;

class SingleCourseResource extends JsonResource
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
            'demovideo' => DemoVideoResource::collection($this->whenLoaded('demovideo')),
        ];
    }
}

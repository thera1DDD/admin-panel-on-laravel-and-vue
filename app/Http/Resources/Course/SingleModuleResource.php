<?php

namespace App\Http\Resources\Course;

use Illuminate\Http\Resources\Json\JsonResource;

class SingleModuleResource extends JsonResource
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
            'description'=>$this->description,
            'main_image'=>$this->main_image,
            'sort'=>$this->sort,
            'number'=>$this->number,
            'passed' => isset($this->passed) ? $this->passed : false,
        ];
    }
}

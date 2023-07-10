<?php

namespace App\Http\Resources\Course;

use Illuminate\Http\Resources\Json\JsonResource;

class TestResource extends JsonResource
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
            'poster'=>$this->poster,
            'code'=>$this->code,
            'type'=>'test',
            'passed' => isset($this->passed) ? $this->passed : false,
        ];
    }
}

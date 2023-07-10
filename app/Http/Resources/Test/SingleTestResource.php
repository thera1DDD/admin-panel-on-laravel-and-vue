<?php

namespace App\Http\Resources\Test;

use Illuminate\Http\Resources\Json\JsonResource;

class SingleTestResource extends JsonResource
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
            'testable_type'=>$this->testable_type,
            'module'=> $this->module
        ];
    }
}

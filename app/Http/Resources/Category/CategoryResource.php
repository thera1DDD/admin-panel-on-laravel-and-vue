<?php

namespace App\Http\Resources\Category;

use App\Http\Resources\Course\SingleModuleResource;
use Illuminate\Http\Resources\Json\JsonResource;
use function Symfony\Component\Translation\t;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'data'=>$this['data'],
            'additional'=>$this['additional']
        ];
    }
}

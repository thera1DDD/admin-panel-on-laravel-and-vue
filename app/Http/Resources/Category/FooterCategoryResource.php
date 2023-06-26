<?php

namespace App\Http\Resources\Category;

use App\Http\Resources\Course\SingleModuleResource;
use Illuminate\Http\Resources\Json\JsonResource;
use function Symfony\Component\Translation\t;

class FooterCategoryResource extends JsonResource
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
            'id' => $this->id,
            'name'=>$this->name,
            'path'=>$this->path,
            'poster'=>$this->poster,
            'location'=>$this->location,
        ];
    }
}

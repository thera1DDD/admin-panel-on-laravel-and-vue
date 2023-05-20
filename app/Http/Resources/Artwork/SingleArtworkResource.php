<?php

namespace App\Http\Resources\Artwork;

use App\Http\Resources\Course\SingleModuleResource;
use Illuminate\Http\Resources\Json\JsonResource;

class SingleArtworkResource extends JsonResource
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
            'name'=>$this->name,
            'description'=>$this->description,
        ];
    }
}

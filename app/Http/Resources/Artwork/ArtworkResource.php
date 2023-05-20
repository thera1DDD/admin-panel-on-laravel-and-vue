<?php

namespace App\Http\Resources\Artwork;

use App\Http\Resources\Course\SingleModuleResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ArtworkResource extends JsonResource
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
            'description'=>$this->description,
            'filename'=>$this->filename,
            'sort'=>$this->sort,
            'slug'=>$this->slug,
            'language'=>new LanguageResource($this->whenLoaded('language')),
        ];
    }
}

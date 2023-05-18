<?php

namespace App\Http\Resources\Favourite;

use Illuminate\Http\Resources\Json\JsonResource;

class FavouriteResource extends JsonResource
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
            'course'=>  new CourseResource($this->whenLoaded('course')),
            'user'=>  new UserResource($this->whenLoaded('user')),
        ];
    }
}

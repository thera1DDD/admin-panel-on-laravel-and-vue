<?php

namespace App\Http\Resources\Dictionary;

use Illuminate\Http\Resources\Json\JsonResource;

class BackwardsTranslateResource extends JsonResource
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
            'word' => $this->translate,
            'translate' => $this->word->name,
        ];
    }
}

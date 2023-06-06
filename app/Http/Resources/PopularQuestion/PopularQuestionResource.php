<?php

namespace App\Http\Resources\PopularQuestion;

use App\Http\Resources\Course\SingleModuleResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PopularQuestionResource extends JsonResource
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
            'question'=>$this->question,
            'answer'=>$this->answer
        ];
    }
}

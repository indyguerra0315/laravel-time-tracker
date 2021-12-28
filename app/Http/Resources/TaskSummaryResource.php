<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TaskSummaryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // Map Domain TaskSummary model values
        return [
            'name' => $this->name()->value(),
            'totalTime' => gmdate("z\d H\h i\m s\s", $this->totalTime()->value())
        ];
    }
}

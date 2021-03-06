<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // Map Domain Task model values
        $data = [
            'id' => $this->id()->value(),
            'name' => $this->name()->value(),
            'startTime' => $this->startTime()->value(),
            'isOpen' => $this->isOpen()->value()
        ];

        if (!$this->isOpen()->value()) {
            $data['endTime'] = $this->endTime()->value();
        }

        return $data;
    }
}

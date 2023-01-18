<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SectionsWithTypes2Resource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */



    public function toArray($request)
    {
        $this->wrap(null);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'once' => true,
        ];
    }
}
<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserTestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'ambulance' => $this->resource->ambulance,
            'result' => $this->resource->result,
            'user' => new UserResource($this->resource->user),
            'covidTest' => new CovidTestResource($this->resource->covidTest),
            'created_at' => $this->resource->created_at
        ];
    }
}

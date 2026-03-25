<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WorkshopLocationResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'            => $this->id,
            'site_code'     => $this->site_code,
            'location_name' => $this->location_name,
            'address'       => $this->address,
            'created_at'    => $this->created_at,
            'updated_at'    => $this->updated_at,
        ];
    }
}
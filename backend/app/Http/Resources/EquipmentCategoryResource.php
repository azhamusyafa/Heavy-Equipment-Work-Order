<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EquipmentCategoryResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'                    => $this->id,
            'category_name'         => $this->category_name,
            'manual_book_file_path' => $this->manual_book_file_path
                ? asset('storage/' . $this->manual_book_file_path)
                : null,
            'is_active'             => $this->is_active,
            'created_at'            => $this->created_at,
            'updated_at'            => $this->updated_at,
        ];
    }
}
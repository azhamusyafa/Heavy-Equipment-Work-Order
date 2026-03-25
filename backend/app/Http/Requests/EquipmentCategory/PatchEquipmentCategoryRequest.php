<?php

namespace App\Http\Requests\EquipmentCategory;

use Illuminate\Foundation\Http\FormRequest;

class PatchEquipmentCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_name' => 'sometimes|string|max:150',
            'is_active'     => 'sometimes|boolean',
            'manual_book'   => 'sometimes|file|mimes:pdf|max:5120',
        ];
    }
}
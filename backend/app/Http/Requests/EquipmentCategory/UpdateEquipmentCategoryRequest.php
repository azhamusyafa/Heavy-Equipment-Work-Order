<?php

namespace App\Http\Requests\EquipmentCategory;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEquipmentCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_name' => 'required|string|max:150',
            'is_active'     => 'required|boolean',
            'manual_book'   => 'nullable|file|mimes:pdf|max:5120',
        ];
    }
}
<?php

namespace App\Http\Requests\MaintenanceType;

use Illuminate\Foundation\Http\FormRequest;

class StoreMaintenanceTypeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'code'        => 'required|string|max:10|unique:master_maintenance_types,code',
            'name'        => 'required|string|max:100',
            'description' => 'nullable|string',
        ];
    }
}
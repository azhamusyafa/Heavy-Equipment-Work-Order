<?php

namespace App\Http\Requests\MaintenanceType;

use Illuminate\Foundation\Http\FormRequest;

class PatchMaintenanceTypeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('maintenance_type');

        return [
            'code'        => "sometimes|string|max:10|unique:master_maintenance_types,code,{$id}",
            'name'        => 'sometimes|string|max:100',
            'description' => 'sometimes|nullable|string',
        ];
    }
}
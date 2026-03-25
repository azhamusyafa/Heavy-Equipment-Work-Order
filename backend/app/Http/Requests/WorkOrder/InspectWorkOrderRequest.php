<?php

namespace App\Http\Requests\WorkOrder;

use Illuminate\Foundation\Http\FormRequest;

class InspectWorkOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'inspection_notes'      => 'required|string',
            'estimated_repair_cost' => 'required|numeric|min:0',
        ];
    }
}
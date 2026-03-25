<?php

namespace App\Http\Requests\WorkOrder;

use Illuminate\Foundation\Http\FormRequest;

class CompleteWorkOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'actual_repair_cost'  => 'required|numeric|min:0',
            'replaced_parts_log'  => 'required|string',
        ];
    }
}
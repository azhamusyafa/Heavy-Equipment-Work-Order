<?php

namespace App\Http\Requests\WorkOrder;

use App\Models\MaintenanceType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreWorkOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'maintenance_type_id'      => 'required|integer|exists:master_maintenance_types,id',
            'equipment_category_id'    => 'required|integer|exists:master_equipment_categories,id',
            'workshop_location_id'     => 'required|integer|exists:master_workshop_locations,id',
            'equipment_serial_number'  => 'required|string|max:100',
            'current_hour_meter'       => 'required|integer|min:0',
            'reporter_name'            => 'required|string|max:150',
            'breakdown_symptom'        => 'required|string',
            'reported_at'              => 'required|date|before_or_equal:now',
            'is_machine_down'          => 'required|boolean',
            'damage_photo'             => 'required|file|mimes:jpg,jpeg,png|max:2048',
        ];
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            $maintenanceTypeId = $this->input('maintenance_type_id');
            $isMachineDown = $this->input('is_machine_down');

            if ($maintenanceTypeId) {
                $type = MaintenanceType::find($maintenanceTypeId);
                if ($type && $type->code === 'BD' && !filter_var($isMachineDown, FILTER_VALIDATE_BOOLEAN)) {
                    $validator->errors()->add('is_machine_down', "Status mesin mati wajib bernilai 'Ya' untuk tipe perbaikan Breakdown.");
                }
            }
        });
    }
}
<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WorkOrderResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'                       => $this->id,
            'wo_number'                => $this->wo_number,
            'equipment_serial_number'  => $this->equipment_serial_number,
            'current_hour_meter'       => $this->current_hour_meter,
            'reporter_name'            => $this->reporter_name,
            'breakdown_symptom'        => $this->breakdown_symptom,
            'reported_at'              => $this->reported_at,
            'scheduled_date'           => $this->scheduled_date,
            'is_machine_down'          => $this->is_machine_down,
            'damage_photo_path'        => asset('storage/' . $this->damage_photo_path),
            'estimated_repair_cost'    => $this->estimated_repair_cost,
            'actual_repair_cost'       => $this->actual_repair_cost,
            'status'                   => $this->status,
            'inspection_notes'         => $this->inspection_notes,
            'lead_mechanic_name'       => $this->lead_mechanic_name,
            'replaced_parts_log'       => $this->replaced_parts_log,
            'inspected_at'             => $this->inspected_at,
            'completed_at'             => $this->completed_at,
            'created_at'               => $this->created_at,
            'maintenance_type'         => $this->whenLoaded('maintenanceType', fn() => [
                'id'   => $this->maintenanceType->id,
                'code' => $this->maintenanceType->code,
                'name' => $this->maintenanceType->name,
            ]),
            'equipment_category'       => $this->whenLoaded('equipmentCategory', fn() => [
                'id'            => $this->equipmentCategory->id,
                'category_name' => $this->equipmentCategory->category_name,
            ]),
            'workshop_location'        => $this->whenLoaded('workshopLocation', fn() => [
                'id'            => $this->workshopLocation->id,
                'site_code'     => $this->workshopLocation->site_code,
                'location_name' => $this->workshopLocation->location_name,
            ]),
        ];
    }
}
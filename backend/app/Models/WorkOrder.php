<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorkOrder extends Model
{
    use SoftDeletes, HasUuids;

    protected $table = 'work_order_transactions';

    protected $fillable = [
        'wo_number',
        'maintenance_type_id',
        'equipment_category_id',
        'workshop_location_id',
        'equipment_serial_number',
        'current_hour_meter',
        'reporter_name',
        'breakdown_symptom',
        'reported_at',
        'scheduled_date',
        'is_machine_down',
        'damage_photo_path',
        'estimated_repair_cost',
        'actual_repair_cost',
        'status',
        'inspection_notes',
        'lead_mechanic_name',
        'replaced_parts_log',
        'inspected_at',
        'completed_at',
        'created_by_ip',
    ];

    protected $casts = [
        'is_machine_down' => 'boolean',
        'reported_at' => 'datetime',
        'scheduled_date' => 'datetime',
        'inspected_at' => 'datetime',
        'completed_at' => 'datetime',
        'estimated_repair_cost' => 'decimal:2',
        'actual_repair_cost' => 'decimal:2',
    ];

    public function maintenanceType(): BelongsTo
    {
        return $this->belongsTo(MaintenanceType::class, 'maintenance_type_id')->withTrashed();
    }

    public function equipmentCategory(): BelongsTo
    {
        return $this->belongsTo(EquipmentCategory::class, 'equipment_category_id')->withTrashed();
    }

    public function workshopLocation(): BelongsTo
    {
        return $this->belongsTo(WorkshopLocation::class, 'workshop_location_id')->withTrashed();
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WorkshopLocation extends Model
{
    use SoftDeletes;

    protected $table = 'master_workshop_locations';

    protected $fillable = [
        'site_code',
        'location_name',
        'address',
    ];

    public function workOrders(): HasMany
    {
        return $this->hasMany(WorkOrder::class, 'workshop_location_id');
    }
}
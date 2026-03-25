<?php

namespace Database\Seeders;

use App\Models\MaintenanceType;
use Illuminate\Database\Seeder;

class MaintenanceTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            ['code' => 'PM', 'name' => 'Preventive Maintenance', 'description' => 'Perawatan rutin terjadwal berdasarkan hour meter.'],
            ['code' => 'BD', 'name' => 'Breakdown', 'description' => 'Perbaikan darurat akibat kerusakan total (mesin mati).'],
            ['code' => 'CM', 'name' => 'Corrective Maintenance', 'description' => null],
        ];

        foreach ($types as $type) {
            MaintenanceType::firstOrCreate(['code' => $type['code']], $type);
        }
    }
}
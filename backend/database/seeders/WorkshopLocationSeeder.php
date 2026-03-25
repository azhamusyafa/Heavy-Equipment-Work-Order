<?php

namespace Database\Seeders;

use App\Models\WorkshopLocation;
use Illuminate\Database\Seeder;

class WorkshopLocationSeeder extends Seeder
{
    public function run(): void
    {
        $locations = [
            ['site_code' => 'JKT-01', 'location_name' => 'Bengkel Utama Jakarta', 'address' => 'Jl. Industri Raya No. 10, Jakarta Utara'],
            ['site_code' => 'SBY-MAIN', 'location_name' => 'Workshop Alat Berat Surabaya', 'address' => 'Kawasan Industri Rungkut Kav. 45, Surabaya'],
        ];

        foreach ($locations as $location) {
            WorkshopLocation::firstOrCreate(['site_code' => $location['site_code']], $location);
        }
    }
}
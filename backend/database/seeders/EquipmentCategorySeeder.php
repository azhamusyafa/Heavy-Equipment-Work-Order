<?php

namespace Database\Seeders;

use App\Models\EquipmentCategory;
use Illuminate\Database\Seeder;

class EquipmentCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['category_name' => 'Excavator 20-Ton', 'is_active' => true, 'manual_book_file_path' => null],
            ['category_name' => 'Bulldozer D85', 'is_active' => true, 'manual_book_file_path' => null],
            ['category_name' => 'Dump Truck 10-Roda', 'is_active' => true, 'manual_book_file_path' => null],
        ];

        foreach ($categories as $category) {
            EquipmentCategory::firstOrCreate(['category_name' => $category['category_name']], $category);
        }
    }
}
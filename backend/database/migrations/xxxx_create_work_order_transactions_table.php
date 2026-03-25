<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('work_order_transactions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('wo_number', 50)->unique();
            $table->foreignId('maintenance_type_id')->constrained('master_maintenance_types');
            $table->foreignId('equipment_category_id')->constrained('master_equipment_categories');
            $table->foreignId('workshop_location_id')->constrained('master_workshop_locations');
            $table->string('equipment_serial_number', 100);
            $table->integer('current_hour_meter');
            $table->string('reporter_name', 150);
            $table->text('breakdown_symptom');
            $table->timestamp('reported_at');
            $table->timestamp('scheduled_date')->nullable();
            $table->boolean('is_machine_down')->default(false);
            $table->string('damage_photo_path', 255);
            $table->decimal('estimated_repair_cost', 15, 2)->nullable();
            $table->decimal('actual_repair_cost', 15, 2)->nullable();
            $table->string('status', 30)->default('OPEN');
            $table->text('inspection_notes')->nullable();
            $table->string('lead_mechanic_name', 150)->nullable();
            $table->text('replaced_parts_log')->nullable();
            $table->timestamp('inspected_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->string('created_by_ip', 45)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index('status');
            $table->index('wo_number');
            $table->index('reported_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('work_order_transactions');
    }
};
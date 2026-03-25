<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('master_workshop_locations', function (Blueprint $table) {
            $table->id();
            $table->string('site_code', 20)->unique();
            $table->string('location_name', 150);
            $table->text('address');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('master_workshop_locations');
    }
};
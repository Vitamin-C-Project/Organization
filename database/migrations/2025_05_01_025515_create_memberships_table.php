<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('memberships', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Member::class, 'member_id')->references('id')->on('members')->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\AcademicYear::class, 'year_id')->references('id')->on('academic_years')->noActionOnDelete();
            $table->foreignIdFor(\App\Models\Position::class)->references('id')->on('positions')->cascadeOnDelete();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('memberships');
    }
};

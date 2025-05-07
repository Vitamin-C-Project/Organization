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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\AcademicYear::class, "year_id")->references("id")->on("academic_years")->noActionOnDelete();
            $table->string('name', 100)->default('');
            $table->string('phone', 15)->default('');
            $table->foreignIdFor(\App\Models\Grade::class, "grade_id")->references("id")->on("grades")->noActionOnDelete();
            $table->enum('gender', ['L', 'P'])->default('L');
            $table->string('birth_place', 15)->nullable();
            $table->date('birth_date')->nullable();
            $table->text('address')->nullable();
            $table->string('father_name', 100)->nullable();
            $table->boolean('status')->default(true);
            $table->string('created_by', 100)->default('');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};

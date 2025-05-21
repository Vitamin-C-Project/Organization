<?php

use App\Models\Member;
use App\Models\Membership;
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
        Schema::create('alumni', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Member::class, 'member_id')->nullable()->references('id')->on('members')->cascadeOnDelete();
            $table->foreignIdFor(Membership::class, 'membership_id')->nullable()->references('id')->on('memberships')->cascadeOnDelete();
            $table->string('destination_name', 100)->default('-');
            $table->string('appointment', 100)->default('-');
            $table->string('graduation_year', 10)->default('-');
            $table->tinyInteger('type')->default(1)->comment('1: Kerja, 2: Kuliah, 3: Wirausaha, 4: Lainnya');
            $table->boolean('status')->default(true)->comment('1: Aktif, 0: Tidak Aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumni');
    }
};

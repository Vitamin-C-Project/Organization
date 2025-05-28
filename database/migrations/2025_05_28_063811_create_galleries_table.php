<?php

use App\Models\Album;
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
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Album::class, 'album_id')->nullable()->references('id')->on('albums')->cascadeOnDelete();
            $table->string("file_name", 100)->default("");
            $table->string("file_path", 100)->default("");
            $table->string("file_type", 100)->default("");
            $table->string("file_extension", 100)->default("");
            $table->integer("file_size")->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galleries');
    }
};

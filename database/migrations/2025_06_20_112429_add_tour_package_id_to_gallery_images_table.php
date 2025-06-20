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
        Schema::table('gallery_images', function (Blueprint $table) {
            $table->foreignId('tour_package_id')->nullable()->constrained('tour_packages')->nullOnDelete();
            $table->string('caption')->nullable();
            $table->integer('sort_order')->default(0);
            $table->renameColumn('image', 'image_path');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gallery_images', function (Blueprint $table) {
            $table->renameColumn('image_path', 'image');
            $table->dropForeign(['tour_package_id']);
            $table->dropColumn(['tour_package_id', 'caption', 'sort_order']);
        });
    }
};

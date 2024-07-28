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
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255)->charset('utf8mb4')->collation('utf8mb4_unicode_ci')->nullable();
            $table->string('slug', 255)->charset('utf8mb4')->collation('utf8mb4_0900_ai_ci')->nullable();
            $table->string('meta_title', 255)->charset('utf8mb4')->collation('utf8mb4_0900_ai_ci')->nullable();
            $table->text('meta_description')->charset('utf8mb4')->collation('utf8mb4_0900_ai_ci')->nullable();
            $table->string('meta_keywords', 255)->charset('utf8mb4')->collation('utf8mb4_0900_ai_ci')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->integer('created_by')->nullable();
            $table->tinyInteger('is_delete')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};

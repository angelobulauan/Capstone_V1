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
        Schema::create('seaviews_likes', function (Blueprint $table) {
            $table->id();
            $table->string('seaview_id')->nullable();
            $table->string('user_id')->nullable();
            $table->string('like_dislike')->nullable();
            $table->string('comments')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seaviews_likes');
    }
};

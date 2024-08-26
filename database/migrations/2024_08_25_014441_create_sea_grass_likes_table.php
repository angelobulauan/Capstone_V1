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
        Schema::create('sea_grass_likes', function (Blueprint $table) {
            $table->id();
            $table->integer('u_id')->nullable();
            $table->integer('seaviews_id')->nullable();
            $table->integer('likes')->nullable();
            $table->integer('dislikes')->nullable();
            $table->integer('views')->nullable();
            $table->timestamps();

            $table->foreign('seaviews_id')->references('id')->on('seaviews')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sea_grass_likes');
    }
};

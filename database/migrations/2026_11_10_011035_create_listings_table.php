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
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('destination_id')->constrained()->cascadeOnDelete();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('tagline')->nullable();
            $table->text('description')->nullable();
            $table->string('price_level')->default('$$'); // $, $$, $$$, $$$$
            $table->decimal('price_avg', 10, 2)->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('website_url')->nullable();
            $table->string('image_url')->nullable();
            $table->json('gallery')->nullable();
            $table->decimal('rating', 3, 2)->default(5.00);
            $table->unsignedInteger('review_count')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_verified')->default(false);
            $table->boolean('is_claimed')->default(false);
            $table->string('subscription_tier')->default('free'); // free, pro, vip
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
};

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
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->string('heading')->nullable();
            $table->string('subheading')->nullable();
            $table->string('slug_url');
            $table->string('image');
            $table->string('banner')->nullable();
            $table->string('mobile_banner')->nullable();
            $table->text('description');
            $table->string('about_title')->unique();
            $table->string('about_image')->nullable();
            $table->string('about_heading')->nullable();
            $table->string('about_subheading')->nullable();
            $table->text('about_description')->nullable();
            $table->string('ths')->nullable();
            $table->string('learn')->nullable();
            $table->string('environment')->nullable();
            $table->enum('is_front', ['no', 'yes'])->default('yes');
            $table->enum('is_active', ['1', '2'])->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branches');
    }
};

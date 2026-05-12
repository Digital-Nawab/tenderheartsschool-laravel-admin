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
        Schema::create('branch_abouts', function (Blueprint $table) {
            $table->id();
            $table->integer('branch_id');
            $table->string('title');
            $table->string('heading')->nullable();
            $table->string('subheading')->nullable();
            $table->string('image');
            $table->string('banner')->nullable();
            $table->string('mobile_banner')->nullable();
            $table->text('description');
            $table->text('long_description');
            $table->text('vision')->unique();
            $table->text('mission')->nullable();
            $table->text('value')->nullable();
            $table->enum('is_active', ['1', '2'])->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branch_abouts');
    }
};

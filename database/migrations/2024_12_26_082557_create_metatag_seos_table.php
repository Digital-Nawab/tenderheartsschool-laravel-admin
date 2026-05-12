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
        Schema::create('metatag_seos', function (Blueprint $table) {
            $table->id();
            $table->string('url');
            $table->string('title');
            $table->string('description');
            $table->string('keyword')->nullable();
            $table->string('image')->nullable();
            $table->enum('is_active', ['1', '2'])->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('metatag_seos');
    }
};

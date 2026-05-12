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
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('heading');
            $table->enum('page', ['about','academy'])->default('about')->comment('about = About Home Page, academy = academy Inner page');
            $table->enum('is_index', ['Y','N'])->default('N')->comment('Y = About Home Page, N = About Inner page');
            $table->string('image')->nullable();
            $table->text('description');
            $table->enum('is_active', ['1','2'])->default('1')->comment('1 = Active, 2 = Inactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abouts');
    }
};

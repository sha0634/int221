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
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('template_name');
            $table->string('theme_color')->default('default');
            $table->string('title')->nullable();
            $table->text('bio')->nullable();
            $table->longText('about_text')->nullable();
            $table->string('avatar')->nullable();
            $table->string('banner')->nullable();
            $table->json('skills')->nullable();
            $table->json('projects')->nullable();
            $table->json('social_links')->nullable();
            $table->string('slug')->unique();
            $table->boolean('is_live')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portfolios');
    }
};

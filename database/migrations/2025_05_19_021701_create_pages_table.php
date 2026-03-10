<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique(); // For SEO-friendly URLs
            $table->text('content')->nullable(); // For Summernote content (About section)

            // SEO fields
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->string('title1')->nullable();
            $table->string('title2')->nullable();
            $table->string('short_desc1')->nullable();
            $table->string('short_desc2')->nullable();
            $table->longText('desc1')->nullable();
            $table->longText('desc2')->nullable();

            // Images (stored as file paths)
            $table->string('image1')->nullable();
            $table->string('image2')->nullable();
            $table->string('video1')->nullable();
            $table->string('video2')->nullable();

            // Optional JSON column for storing multiple image filenames/paths
            $table->json('gallery_images')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};


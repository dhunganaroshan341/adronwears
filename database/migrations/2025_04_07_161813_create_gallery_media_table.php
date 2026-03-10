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
        Schema::create('gallery_media', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('gallery_album_id');
            $table->string('media_path')->nullable();
            $table->foreign('gallery_album_id')->references('id')->on('gallery_albums')->onDelete('cascade');
            $table->enum('status',['Active','Inactive'])->default('Active');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gallery_media');
    }
};

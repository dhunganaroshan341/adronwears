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
        Schema::create('home_slides', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->string('title');
            $table->text('shortdesc')->nullable();
            $table->string('link_text')->nullable();
            $table->string('link_url')->nullable();
            $table->enum('status',['Active','Inactive'])->default('Active');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_slides');
    }
};

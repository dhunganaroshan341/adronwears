<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('destinations', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('image'); // e.g. 'template/yatri_world/main-file/images/destination/destination5.jpg'
        $table->unsignedTinyInteger('rating')->default(5); // 1 to 5 stars
        $table->string('button_text')->default('Book Now');
$table->enum('status', ['Active', 'Inactive'])->default('active');

        $table->string('button_link')->default('#');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destinations');
    }
};

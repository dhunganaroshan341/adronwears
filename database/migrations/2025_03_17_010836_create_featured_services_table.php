<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeaturedServicesTable extends Migration
{
    public function up()
    {
        Schema::create('featured_services', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key (id)
            $table->foreignId('service_id')->constrained()->onDelete('cascade'); // Assuming a 'services' table exists, foreign key to service_id
            $table->integer('sort_order'); // 'sort_order' column
            $table->timestamps(); // Automatically handles 'created_at' and 'updated_at'
        });
    }

    public function down()
    {
        Schema::dropIfExists('featured_services');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key (id)
            $table->string('name', 100); // 'name' column (required, maximum length 100)
            $table->string('short_desc', 255)->nullable(); // 'short_desc' column (nullable)
            $table->text('description')->nullable(); // 'description' column (nullable, TEXT type)
            $table->integer('status')->default(1); // 'status' column (default to 1)
            $table->integer('price')->default(100); // 'status' column (default to 1)
            $table->timestamps(); // 'created_at' and 'updated_at' columns
            $table->string('image', 100)->nullable(); // 'image' column (nullable, maximum length 100)
        });
    }

    public function down()
    {
        Schema::dropIfExists('services');
    }
}

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
    Schema::table('tour_packages', function (Blueprint $table) {
        $table->longText('price_includes')->nullable()->change();
        $table->longText('price_excludes')->nullable()->change();
    });
}

public function down(): void
{
    Schema::table('tour_packages', function (Blueprint $table) {
        $table->json('price_includes')->nullable()->change();
        $table->json('price_excludes')->nullable()->change();
    });
}

};

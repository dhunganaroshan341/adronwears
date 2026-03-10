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
    Schema::table('teams', function (Blueprint $table) {
        if (!Schema::hasColumn('teams', 'order')) {
            $table->unsignedInteger('order')->default(0)->after('instagram');
        }
    });
}

public function down(): void
{
    Schema::table('teams', function (Blueprint $table) {
        if (Schema::hasColumn('teams', 'order')) {
            $table->dropColumn('order');
        }
    });
}


    /**
     * Reverse the migrations.
     */

};

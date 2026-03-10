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
        Schema::table('settings', function (Blueprint $table) {
            $table->string('address2')->nullable();   // India office address
            $table->string('phone3')->nullable();     // India office mobile 1
            $table->string('phone4')->nullable();     // India office mobile 2
            $table->string('landline1')->nullable();  // Nepal office landline
            $table->string('landline2')->nullable();  // India office landline
            $table->string('contact2')->nullable();   // Secondary contact for India office
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn(['address2', 'phone3', 'phone4', 'landline1', 'landline2', 'contact2']);
        });
    }
};

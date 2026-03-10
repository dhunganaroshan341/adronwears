<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTourPackageTypeIdToTourPackagesTable extends Migration
{
    public function up()
    {
        Schema::table('tour_packages', function (Blueprint $table) {
            $table->unsignedBigInteger('tour_package_type_id')->nullable()->after('our_country_id');

            // If you have a tour_package_types table and want a foreign key constraint, add this:
            $table->foreign('tour_package_type_id')->references('id')->on('tour_package_types')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('tour_packages', function (Blueprint $table) {
            $table->dropForeign(['tour_package_type_id']);
            $table->dropColumn('tour_package_type_id');
        });
    }
}

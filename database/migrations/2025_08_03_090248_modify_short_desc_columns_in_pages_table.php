<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyShortDescColumnsInPagesTable extends Migration
{
    public function up()
    {
        Schema::table('pages', function (Blueprint $table) {
            // Allow nullable and change type to text
            $table->text('short_desc1')->nullable()->change();
            $table->text('short_desc2')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->string('short_desc1', 255)->nullable(false)->change();
            $table->string('short_desc2', 255)->nullable(false)->change();
        });
    }
}

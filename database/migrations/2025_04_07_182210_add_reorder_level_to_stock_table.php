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
        Schema::table('stocks', function (Blueprint $table) {
            // Adding reorder_level column
            $table->integer('reorder_level')->default(0); // Default is 0, adjust as needed
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stocks', function (Blueprint $table) {
            // Dropping the reorder_level column if the migration is rolled back
            $table->dropColumn('reorder_level');
        });
    }
};

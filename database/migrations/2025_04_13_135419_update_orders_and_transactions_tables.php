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
        // Remove vat_amount from orders table
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('vat_amount');  // Drop vat_amount from orders table
        });

    }

    public function down()
    {
        // Add vat_amount back to orders table in case we rollback
        Schema::table('orders', function (Blueprint $table) {
            $table->decimal('vat_amount', 10, 2)->nullable();  // Add vat_amount back to orders table
        });
    }
};

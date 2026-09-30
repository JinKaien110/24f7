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
        Schema::table('transactions', function (Blueprint $table) {
            $table->decimal('vat_amount', 10, 2)->after('amount_paid')->nullable();
            $table->decimal('change', 10, 2)->after('vat_amount')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn(['vat_amount', 'change']);
        });
    }
};

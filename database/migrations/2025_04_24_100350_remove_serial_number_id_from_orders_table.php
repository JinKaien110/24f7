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
        Schema::table('orders', function (Blueprint $table) {
            // First drop the foreign key constraint
            $table->dropForeign(['serial_number_id']);

            // Then drop the actual column
            $table->dropColumn('serial_number_id');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('serial_number_id')->nullable();

            $table->foreign('serial_number_id')
                  ->references('id')
                  ->on('product_serials')
                  ->onDelete('set null');
        });
    }
    
};

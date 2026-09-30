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
        Schema::table('orders', function (Blueprint $table) {
            // Add the refund_status column with ENUM values
            $table->enum('refund_status', ['none', 'requested', 'approved', 'rejected'])->default('none')->after('status');
            $table->string('action_reason')->nullable()->after('refund_status');
            $table->enum('status', ['pending', 'complete', 'cancelled', 'refunded'])->default('pending')->change();
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Rollback the changes
            $table->dropColumn(['refund_status', 'action_reason']);
        });
    }
};

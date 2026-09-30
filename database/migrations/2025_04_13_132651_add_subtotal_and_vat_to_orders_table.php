<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up() {
    Schema::table('orders', function (Blueprint $table) {
        $table->decimal('price', 10, 2)->after('user_id');
        $table->decimal('subtotal', 10, 2)->after('price');
        $table->decimal('vat_amount', 10, 2)->after('subtotal');
    });
}

public function down() {
    Schema::table('orders', function (Blueprint $table) {
        $table->dropColumn(['subtotal', 'vat_amount', 'price']);
    });
}

};

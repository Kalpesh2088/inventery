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
        Schema::table('sales', function (Blueprint $table) {
            $table->bigInteger('customer_id')->after('products_id')->default(0);
            $table->bigInteger('payment_id')->after('customer_id')->default(0);
            $table->bigInteger('delivery_id')->after('payment_id')->default(0);
            $table->bigInteger('so_number')->after('delivery_id')->default(0);
            $table->string('order_date')->after('so_number')->nullable();
            $table->string('expected_shipment_date')->after('order_date')->nullable();
            $table->string('attachFile')->after('expected_shipment_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->dropColumn('customer_id');
            $table->dropColumn('payment_id');
            $table->dropColumn('delivery_id');
            $table->dropColumn('so_number');
            $table->dropColumn('order_date');
            $table->dropColumn('expected_shipment_date');
            $table->dropColumn('attachFile');
        });
    }
};

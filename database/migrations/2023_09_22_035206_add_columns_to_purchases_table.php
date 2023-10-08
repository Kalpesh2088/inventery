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
        Schema::table('purchases', function (Blueprint $table) {
            $table->bigInteger('request_numbe')->after('products_id')->default(0);
            $table->string('date')->after('request_numbe')->nullable();
            $table->string('delivery_date')->after('date')->nullable();
            $table->string('supplier_id')->after('delivery_date')->nullable();
            $table->string('supplier_invoice_number')->after('supplier_id')->nullable(); 
            $table->string('packaging_type')->after('supplier_invoice_number')->nullable();
            $table->string('description')->after('packaging_type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('purchases', function (Blueprint $table) {
            $table->dropColumn('request_numbe');
            $table->dropColumn('date');
            $table->dropColumn('delivery_date');
            $table->dropColumn('supplier_id');
            $table->dropColumn('supplier_invoice_number');
            $table->dropColumn('packaging_type');
            $table->dropColumn('description');
        });
    }
};

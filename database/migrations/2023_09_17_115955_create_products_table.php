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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('category_id')->default(0);
            $table->bigInteger('brand_id')->default(0);
            $table->bigInteger('discount_id')->default(0);
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->integer('unit')->default(0);
            $table->integer('minimum_quantity')->default(0);
            $table->integer('quantity')->default(0);
            $table->text('description')->nullable();
            $table->integer('tex')->default(0);
            $table->integer('price')->default(0);
            $table->tinyInteger('status')->default(1);
            $table->string('thumbnail')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
